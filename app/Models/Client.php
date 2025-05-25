<?php

namespace App\Models;

use Laravel\Passport\Client as PassportClient;

class Client extends PassportClient
{
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'oauth_client_role', 'oauth_client_id', 'role_id')->withTimestamps();
    }
}
