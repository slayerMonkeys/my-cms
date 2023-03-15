<?php

namespace App\Policies;

use App\Enums\Permissions\PostPermissions;
use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission(PostPermissions::VIEW_ANY_POSTS);
    }

    /**
     * Determine whether the user can create the model
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->hasPermission(PostPermissions::CREATE_POSTS);
    }

    /**
     * Determine whether the user can update the model
     *
     * @param User $user
     * @param Post $post
     * @return bool
     */
    public function update(User $user, Post $post): bool
    {
        return $user->hasPermission(PostPermissions::UPDATE_POSTS) ||
            ($user->hasPermission(PostPermissions::UPDATE_OWN_POSTS) && $user->id === $post->user_id);
    }

    /**
     * Determine whether the user can delete the model
     *
     * @param User $user
     * @param Post $post
     * @return bool
     */
    public function delete(User $user, Post $post): bool
    {
        return $user->hasPermission(PostPermissions::DELETE_POSTS) ||
            ($user->hasPermission(PostPermissions::DELETE_OWN_POSTS) && $user->id === $post->user_id);
    }
}
