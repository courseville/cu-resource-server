<?php

namespace App\Ldap;

use LdapRecord\Models\OpenLDAP\User as OpenLDAPUser;

class User extends OpenLDAPUser
{
    /**
     * The attribute that should be used for identification.
     */
    public static string $username = 'mail';

    /**
     * The attribute that should be used for the model's GUID.
     */
    protected string $guidKey = 'uid';
}
