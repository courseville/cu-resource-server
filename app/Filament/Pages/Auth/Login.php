<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Login as BaseLogin;
use Filament\Schemas\Components\Component;
use Filament\Forms\Components\TextInput;

class Login extends BaseLogin
{
    protected function getEmailFormComponent(): Component
    {
        /** @var TextInput $component */
        $component = TextInput::make('email')
            ->label(__('filament-panels::auth/pages/login.form.email.label'))
            ->required()
            ->autocomplete()
            ->autofocus()
            ->extraInputAttributes(['tabindex' => 1]);

        return $component;
    }

    protected function getCredentialsFromFormData(array $data): array
    {
        return [
            'email' => $data['email'],
            'password' => $data['password'],
        ];
    }
}
