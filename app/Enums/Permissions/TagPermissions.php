<?php

namespace App\Enums\Permissions;

final class TagPermissions
{
    /**
     * Allow to view any tags.
     */
    public const VIEW_ANY_TAGS = 'view-any-tags';

    /**
     * Allow to view a tag.
     */
    public const VIEW_TAGS = 'view-tags';

    /**
     * Allow to create a tag.
     */
    public const CREATE_TAGS = 'create-tags';

    /**
     * Allow to update a tag.
     */
    public const UPDATE_TAGS = 'update-tags';

    /**
     * Allow to delete a tag.
     */
    public const DELETE_TAGS = 'delete-tags';

    /**
     * All permissions for tags.
     *
     * @var array|string[]
     */
    private static array $_tagPermissions = [
        self::VIEW_ANY_TAGS,
        self::VIEW_TAGS,
        self::CREATE_TAGS,
        self::UPDATE_TAGS,
        self::DELETE_TAGS
    ];

    /**
     * Get all permissions for tags.
     *
     * @return array|string[]
     */
    public static function all(): array
    {
        return self::$_tagPermissions;
    }
}
