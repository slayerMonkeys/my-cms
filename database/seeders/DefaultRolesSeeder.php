<?php

namespace Database\Seeders;

use App\Enums\DefaultRoles;
use App\Enums\Permissions\PostPermissions;
use App\Enums\Permissions\RolePermissions;
use App\Enums\Permissions\UserPermissions;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class DefaultRolesSeeder extends Seeder
{
    public function run()
    {
        $userRole = Role::create(['name' => ucfirst(DefaultRoles::USER), "slug" => DefaultRoles::USER]);

        $userRolePermissions = [
            PostPermissions::VIEW_ANY_POSTS,
            PostPermissions::VIEW_POSTS,
            PostPermissions::CREATE_POSTS,
            PostPermissions::UPDATE_OWN_POSTS,
            PostPermissions::DELETE_OWN_POSTS
        ];

        foreach ($userRolePermissions as $userRolePermission) {
            $permission = Permission::where("slug", $userRolePermission)->first();

            $userRole->permissions()->attach($permission);
        }

        $adminRole = Role::create(['name' => ucfirst(DefaultRoles::ADMINISTRATOR), "slug" => DefaultRoles::ADMINISTRATOR]);

        $adminRolePermissions = [
            ...PostPermissions::all(),
            UserPermissions::VIEW_ANY_USERS,
            UserPermissions::VIEW_USERS,
            RolePermissions::VIEW_ANY_ROLES,
            RolePermissions::VIEW_ROLES
        ];

        foreach ($adminRolePermissions as $adminRolePermission) {
            $permission = Permission::where("slug", $adminRolePermission)->first();

            $adminRole->permissions()->attach($permission);
        }

        Role::create(['name' => ucfirst(DefaultRoles::SUPER_ADMINISTRATOR), "slug" => DefaultRoles::SUPER_ADMINISTRATOR]);
    }
}
