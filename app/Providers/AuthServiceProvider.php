<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [];

    public function boot()
    {
        Gate::define('admin', function ($user) {
            return $user->Rol === 'admin';
        });
    }
}