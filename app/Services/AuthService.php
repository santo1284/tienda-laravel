<?php

namespace App\Services;

class AuthService
{
    public static function isAdmin($user): bool
    {
        $adminEmails = [
            'admin1@admin.com',
            'admin2@admin.com',
            'admin3@admin.com'
        ];

        return in_array($user->email, $adminEmails);
    }

    public static function getRedirectRoute($user): string
    {
        return self::isAdmin($user) ? 'dashboard' : 'tienda';
    }
}