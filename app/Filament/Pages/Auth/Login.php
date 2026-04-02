<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Login as BaseLogin;
use Filament\Facades\Filament;
use SensitiveParameter;

class Login extends BaseLogin
{
    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function getCredentialsFromFormData(#[SensitiveParameter] array $data): array
    {
        $guard = Filament::getAuthGuard();
        $provider = config("auth.guards.{$guard}.provider");
        $driver = config("auth.providers.{$provider}.driver");

        return [
            ($driver === 'ldap' ? 'mail' : 'email') => $data['email'],
            'password' => $data['password'],
        ];
    }
}
