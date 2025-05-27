<?php

namespace App\Providers;

use App\Models\Client;
use App\Services\PermissionService;
use Dedoc\Scramble\Scramble;
use Dedoc\Scramble\Support\Generator\OpenApi;
use Dedoc\Scramble\Support\Generator\SecurityScheme;
use Dedoc\Scramble\Support\Generator\SecuritySchemes\OAuthFlow;
use Gate;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(PermissionService::class, function ($app) {
            return new PermissionService;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Passport::useClientModel(Client::class);
        Passport::personalAccessTokensExpireIn(now()->addMonths(1));
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

            'machine' => 'View global resource',
        ]);

        Passport::setDefaultScope([
            'general.read',
            'machine',
        ]);

        Gate::define('viewApiDocs', function ($user) {
            return in_array($user->email, ['admin@mail.com']);
        });

        Scramble::configure()
            ->withDocumentTransformers(function (OpenApi $openApi) {
                $openApi->secure(
                    // SecurityScheme::http('bearer')
                    SecurityScheme::oauth2()
                        ->flow('clientCredentials', function (OAuthFlow $flow) {
                            $flow
                                ->authorizationUrl(config('app.url').'/oauth/authorize')
                                ->tokenUrl(config('app.url').'/oauth/token')
                                ->addScope('*', 'all');
                        })
                );
            });
    }
}
