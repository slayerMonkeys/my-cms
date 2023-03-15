<?php

namespace App\Policies;

use App\Enums\Permissions\TagPermissions;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TagPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasPermission(TagPermissions::VIEW_ANY_TAGS);
    }

    public function view(User $user, Tag $tag): bool
    {
        return $user->hasPermission(TagPermissions::VIEW_TAGS);
    }

    public function create(User $user): bool
    {
        return $user->hasPermission(TagPermissions::CREATE_TAGS);
    }

    public function update(User $user, Tag $tag): bool
    {
        return $user->hasPermission(TagPermissions::UPDATE_TAGS);
    }

    public function delete(User $user, Tag $tag): bool
    {
        return $user->hasPermission(TagPermissions::DELETE_TAGS);
    }

}
