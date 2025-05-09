<?php

namespace App\Providers;

// Required to define application-specific service providers and bindings.
use Illuminate\Support\Facades\Gate;
// Required to define authorization gates for user roles and permissions.
use Illuminate\Support\ServiceProvider;
// Required to extend the base ServiceProvider class provided by Laravel.
use app\Models\User; // Required to reference the User model for defining authorization logic.

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Placeholder for registering services or bindings into the service container.
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Define a custom authorization gate to check if a user has admin privileges.
        Gate::define('admin', function (User $user) {
            // Check the 'is_admin' property of the User model to determine admin status.
            return $user->is_admin;
        });
    }
}
