<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('direktur', function (User $user) {
            return $user->idpriv === 2;
        });
        Gate::define('dokter', function (User $user) {
            return $user->idpriv === 7;
        });
        Gate::define('perawat', function (User $user) {
            return $user->idpriv === 11;
        });
        Gate::define('rekammedis', function (User $user) {
            return $user->idpriv === 8;
        });
    }
}
