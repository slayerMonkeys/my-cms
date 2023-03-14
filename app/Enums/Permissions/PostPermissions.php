<?php

namespace App\Enums\Permissions;

final class PostPermissions
{
    /**
     * Allow to view any posts.
     */
    public const VIEW_ANY_POSTS = 'view-any-posts';

    /**
     * Allow to view a post.
     */
    public const VIEW_POSTS = 'view-posts';

    /**
     * Allow to create a new post.
     */
    public const CREATE_POSTS = 'create-posts';

    /**
     * Allow to update a post.
     */
    public const UPDATE_POSTS = 'update-posts';

    /**
     * Allow to update only there owns posts.
     */
    public const UPDATE_OWN_POSTS = 'update-own-posts';

    /**
     * Allow to delete a post.
     */
    public const DELETE_POSTS = 'delete-posts';

    /**
     * Allow to delete only there owns posts.
     */
    public const DELETE_OWN_POSTS = 'delete-own-posts';

    /**
     * All permissions for posts.
     *
     * @var array|string[]
     */
    private static array $_postPermissions = [
        self::VIEW_ANY_POSTS,
        self::VIEW_POSTS,
        self::CREATE_POSTS,
        self::UPDATE_POSTS,
        self::UPDATE_OWN_POSTS,
        self::DELETE_POSTS,
        self::DELETE_OWN_POSTS
    ];

    /**
     * Get all permissions for posts.
     *
     * @return array|string[]
     */
    public static function all(): array
    {
        return self::$_postPermissions;
    }
}
