<?php

namespace Database\Seeders;

use App\Enums\Permissions\PostPermissions;
use App\Enums\Permissions\RolePermissions;
use App\Enums\Permissions\TagPermissions;
use App\Enums\Permissions\UserPermissions;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        $permissionsName = [
            ...PostPermissions::all(),
            ...RolePermissions::all(),
            ...UserPermissions::all(),
            ...TagPermissions::all()
        ];

        foreach ($permissionsName as $permissionName) {
            (new Permission(['name' => ucfirst($permissionName), "slug" => $permissionName]))->save();
        }
    }
}
