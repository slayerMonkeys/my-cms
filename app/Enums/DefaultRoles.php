<?php

namespace App\Enums;

final class DefaultRoles
{
    /**
     * Slug of default role super administrator.
     */
    public const SUPER_ADMINISTRATOR = 'super-administrator';

    /**
     * Slug of default role administrator.
     */
    public const ADMINISTRATOR = 'administrator';

    /**
     * Slug of default role user.
     */
    public const USER = 'user';

    /**
     * All slug of default roles.
     *
     * @var array|string[]
     */
    private static array $_roles = [
        self::SUPER_ADMINISTRATOR,
        self::ADMINISTRATOR,
        self::USER
    ];

    /**
     * Get all slug of default roles.
     *
     * @return array|string[]
     */
    public static function all(): array
    {
        return self::$_roles;
    }
}
