<?php

namespace App\Policies;

use App\Enums\DefaultRoles;
use App\Enums\Permissions\RolePermissions;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasPermission(RolePermissions::VIEW_ANY_ROLES);
    }

    public function view(User $user): bool
    {
        return $user->hasPermission(RolePermissions::VIEW_ROLES);
    }

    public function create(User $user): bool
    {
        return $user->hasPermission(RolePermissions::CREATE_ROLES);
    }

    public function update(User $user, Role $role): bool
    {
        return $user->hasPermission(RolePermissions::UPDATE_ROLES) && $role->slug !== DefaultRoles::USER;
    }

    public function delete(User $user, Role $role): bool
    {
        return $user->hasPermission(RolePermissions::DELETE_ROLES) && $role->slug !== DefaultRoles::USER;
    }
}
