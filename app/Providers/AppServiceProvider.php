<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        Gate::define('update-double-auth', function (User $user) {
            return $user->double_auth && $user->verification_code;
        });

        view()->share([
            "statuses" => ['to do', 'in progress', 'done'],
        ]);
    }
}
