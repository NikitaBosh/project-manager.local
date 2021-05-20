<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Сопоставление политик для приложения.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Определение является ли пользователь администратором
        Gate::define('senior', function ($user) {
            if ($user->role == 'senior') {
                return true;
            }
            return false;
        });

        Gate::define('junior', function ($user) {
            if ($user->role == 'junior') {
                return true;
            }
            return false;
        });
        // Определение зарегистрированного обычного пользователя
        Gate::define('user', function ($user) {
            if ($user->role == 'user') {
                return true;
            }
            return false;
        });
    }
}
