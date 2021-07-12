<?php

namespace App\Models;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    public $fillable = [
        "name",
        "display_name",
        "description"
    ];

    public const SYSTEM_ROLES = [
        'doctor',
        'patient',
        'client'
    ];

    public static function name($string)
    {
        return self::whereName($string)->first();
    }

    public static function systemRoles()
    {
        return self::whereIn('name', Role::SYSTEM_ROLES)->get();
    }

    public static function userRoles()
    {
        return self::whereNotIn('name', Role::SYSTEM_ROLES)->get();
    }
}
