FROM php:8.1-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    default-mysql-client \
    libmagickwand-dev \
    supervisor

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure gd --with-jpeg --with-webp \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Imagick extension
RUN pecl install imagick \
    && docker-php-ext-enable imagick

# Set PHP configurations
RUN echo "post_max_size = 100M" >> /usr/local/etc/php/conf.d/docker-php-post.ini \
    && echo "upload_max_filesize = 100M" >> /usr/local/etc/php/conf.d/docker-php-upload.ini \
    && echo "max_execution_time = 120" >> /usr/local/etc/php/conf.d/docker-php-max-execution-time.ini \
    && echo "memory_limit = 512M" >> /usr/local/etc/php/conf.d/docker-php-memory-limit.ini

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Set working directory
WORKDIR /var/www

USER $user