<?php

namespace App\Enums\Permissions;

final class RolePermissions
{
    /**
     * Allow to view any roles.
     */
    public const VIEW_ANY_ROLES = 'view-any-roles';

    /**
     * Allow to view a role.
     */
    public const VIEW_ROLES = 'view-roles';

    /**
     * Allow to create a role.
     */
    public const CREATE_ROLES = 'create-roles';

    /**
     * Allow to update a role.
     */
    public const UPDATE_ROLES = 'update-roles';

    /**
     * Allow to delete a role.
     */
    public const DELETE_ROLES = 'delete-roles';

    /**
     * All permissions for roles.
     *
     * @var array|string[]
     */
    private static array $_rolePermissions = [
        self::VIEW_ANY_ROLES,
        self::VIEW_ROLES,
        self::CREATE_ROLES,
        self::UPDATE_ROLES,
        self::DELETE_ROLES
    ];

    /**
     * Get all permissions for roles.
     *
     * @return array|string[]
     */
    public static function all(): array
    {
        return self::$_rolePermissions;
    }
}
