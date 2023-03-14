<?php

namespace Tests;

use App\Enums\DefaultRoles;
use App\Enums\Permissions\PostPermissions;
use App\Enums\Permissions\RolePermissions;
use App\Enums\Permissions\TagPermissions;
use App\Enums\Permissions\UserPermissions;
use App\Models\Role;
use App\Models\User;
use Database\Seeders\DefaultRolesSeeder;
use Database\Seeders\PermissionsSeeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;

    protected function authenticateUser(string $roleSlug = 'user'): User
    {
        $this->seed([
            PermissionsSeeder::class,
            DefaultRolesSeeder::class
        ]);

        $role = Role::where("slug", $roleSlug)->first();
        $user = User::factory()->hasAttached($role)->create();
        $this->actingAs($user);

        return $user;
    }

    protected function getAllPermissions(): array
    {
        return [
            ...PostPermissions::all(),
            ...RolePermissions::all(),
            ...TagPermissions::all(),
            ...UserPermissions::all()
        ];
    }
}
