<?php

namespace App\Enums\Permissions;

final class UserPermissions
{
    /**
     * Allow to view any users.
     */
    public const VIEW_ANY_USERS = 'view-any-users';

    /**
     * Allow to view a user.
     */
    public const VIEW_USERS = 'view-users';

    /**
     * Allow to create a user.
     */
    public const CREATE_USERS = 'create-users';

    /**
     * Allow to update a user.
     */
    public const UPDATE_USERS = 'update-users';

    /**
     * Allow to delete a user.
     */
    public const DELETE_USERS = 'delete-users';

    /**
     * All permissions for users.
     *
     * @var array|string[]
     */
    private static array $_userPermissions = [
        self::VIEW_ANY_USERS,
        self::VIEW_USERS,
        self::CREATE_USERS,
        self::UPDATE_USERS,
        self::DELETE_USERS
    ];

    /**
     * Get all permissions for users.
     *
     * @return array|string[]
     */
    public static function all(): array
    {
        return self::$_userPermissions;
    }
}
