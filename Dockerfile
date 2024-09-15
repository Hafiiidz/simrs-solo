# Use the official PHP image with FPM
FROM php:8.3-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Install system dependencies
RUN apt-get update && apt-get install -y \
    nano \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    libpq-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev
    # supervisor

# Install GD extension
RUN docker-php-ext-configure gd --with-jpeg=/usr/include/ --with-freetype \
    && docker-php-ext-install gd

# Create log directory with proper permissions
RUN mkdir -p "/etc/supervisor/logs" \
    && chmod -R 777 "/etc/supervisor/logs"

# Copy Supervisor configuration
# COPY supervisord.conf /etc/supervisor/supervisord.conf

# Start supervisord (commented for now)
# CMD ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisor/supervisord.conf"]

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath zip

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Set working directory
WORKDIR /var/www

USER $user
