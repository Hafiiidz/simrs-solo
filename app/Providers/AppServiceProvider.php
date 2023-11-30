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
        config(['app.locale' => 'id']);
        setlocale(LC_ALL, 'IND');
        \Carbon\Carbon::setLocale('id');

        Gate::define('direktur', function (User $user) {
            return $user->idpriv === 2;
        });
        Gate::define('dokter', function (User $user) {
            return $user->idpriv === 7;
        });
        Gate::define('perawat', function (User $user) {
            return $user->idpriv >= 14;
        });
        Gate::define('perawat_ruangan', function (User $user) {
            return $user->idpriv === 11;
        });
        Gate::define('rekammedis', function (User $user) {
            return $user->idpriv === 8;
        });
        Gate::define('farmasi', function (User $user) {
            return $user->idpriv === 10;
        });
        Gate::define('lab', function (User $user) {
            return $user->idpriv === 16;
        });
        Gate::define('radiologi', function (User $user) {
            return $user->idpriv === 15;
        });
        Gate::define('fisio', function (User $user) {
            return $user->idpriv === 29;
        });
        Gate::define('ruangok', function (User $user) {
            return $user->idpriv === 13;
        });
        Gate::define('gizi', function (User $user) {
            return $user->idpriv === 6;
        });
    }
}
