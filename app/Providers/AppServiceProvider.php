<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use App\Models\Client;
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
        Passport::useClientModel(Client::class);
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));
        // Passport::tokensCan([
        //     'student' => 'View user profile',
        //     'admin' => 'Edit user profile',
        //     'machine' => 'View global resource'
        // ]);

        // Passport::setDefaultScope([
        //     'student',
        //     'admin',
        //     'machine',
        // ]);

        Passport::tokensCan([
            'user.read' => 'View user profile',
            'user.update' => 'Update user profile',
            'user.delete' => 'Delete user profile',

            'general.read' => 'Access general public data',

            // Admin-related actions
            'admin.read' => 'View admin resources',
            'admin.update' => 'Modify admin resources',
            'admin.manage' => 'Manage users and system settings',

            'machine' => 'View global resource'
        ]);

        Passport::setDefaultScope([
            'general.read', 
            'machine',
        ]);
    }
}
