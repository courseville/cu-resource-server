<?php

namespace App\Ldap;

use LdapRecord\Models\OpenLDAP\User as OpenLDAPUser;

class User extends OpenLDAPUser
{
    /**
     * The attribute that should be used for identification.
     *
     * @var string
     */
    protected static string $username = 'mail';
}
