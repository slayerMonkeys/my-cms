<?php

namespace App\Policies;

use App\Enums\Permissions\UserPermissions;
use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;
use JetBrains\PhpStorm\Pure;

class UserPolicy
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
        return $user->hasPermission(UserPermissions::VIEW_ANY_USERS);
    }

    /**
     * Determine whether the user can view the model
     *
     * @param User $authUser
     * @param User $user
     * @return bool
     */
    public function view(User $authUser, User $user): bool
    {
        return $authUser->hasPermission(UserPermissions::VIEW_USERS);
    }

    /**
     * Determine whether the user can create the model
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->hasPermission(UserPermissions::CREATE_USERS);
    }

    /**
     * Determine whether the user can update the model
     *
     * @param User $user
     * @return bool
     */
    public function update(User $user): bool
    {
        return $user->hasPermission(UserPermissions::UPDATE_USERS);
    }

    /**
     * Determine whether the user can delete the model
     *
     * @param User $user
     * @param User $target
     * @return bool
     */
    public function delete(User $user, User $target): bool
    {
        return $user->hasPermission(UserPermissions::DELETE_USERS) && $user->id !== $target->id;
    }
}
