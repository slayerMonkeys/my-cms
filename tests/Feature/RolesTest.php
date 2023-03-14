<?php

namespace Tests\Feature;

use App\Enums\DefaultRoles;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class RolesTest extends TestCase
{
    use WithFaker;

    public function testStoreRoleWithPermissions(): void
    {

        $this->authenticateUser(DefaultRoles::SUPER_ADMINISTRATOR);

        $attributes = [
            'name' => $this->faker->unique()->name(),
        ];

        foreach (Permission::all()->random(5) as $permission) {
            $attributes['permission_' . $permission->slug] = $permission->id;
        }
        $response = $this->post(route('admin.roles.store'), $attributes);

        $response->assertStatus(302);
        $response->dumpSession();
        $response->assertSessionHas("success", "Role Created !");

        $this->assertDatabaseHas(Role::class, [
            'name' => $attributes['name'],
            'slug' => Str::slug($attributes['name']),
        ]);
    }

    public function testStoreRoleWithoutPermissions(): void
    {
        $this->authenticateUser();

        $attributes = [
            'name' => $this->faker->unique()->name(),
        ];

        foreach (Permission::all()->random(5) as $permission) {
            $attributes['permission_' . $permission->slug] = $permission->id;
        }
        $response = $this->post(route('admin.roles.store'), $attributes);
        $response->assertStatus(403);
    }

    public function testRenderRoleIndex(): void
    {
        $this->authenticateUser(DefaultRoles::SUPER_ADMINISTRATOR);

        $roles = Role::factory()->count(5)->create();

        $this->assertDatabaseCount('roles', 8); // 5 roles with factory and 3 defaults roles.

        $response = $this->get(route('admin.roles.index'));

        $response->assertStatus(200);
        $response->assertSeeText($roles->pluck('name')->toArray());
    }

    public function testRenderRoleCreatePage(): void
    {
        $this->authenticateUser(DefaultRoles::SUPER_ADMINISTRATOR);

        $response = $this->get(route('admin.roles.create'));
        $response->assertStatus(200);

        $response->assertSeeText(['Name', ...Permission::pluck('name')->toArray()]);
    }

    public function testRenderRoleEditPage(): void
    {
        $this->authenticateUser(DefaultRoles::SUPER_ADMINISTRATOR);

        $role = Role::factory()->create();
        $this->assertDatabaseCount('users', 1);

        $response = $this->get(route('admin.roles.edit', $role));
        $response->assertStatus(200);

        $response->assertSeeText(['Name', ...Permission::pluck('name')->toArray()]);
    }

    public function testUpdateRole(): void
    {
        $this->authenticateUser(DefaultRoles::SUPER_ADMINISTRATOR);

        $role = Role::factory()->create();
        $this->assertDatabaseCount('roles', 4); // 1 role with factory and 3 defaults roles.

        $attributes = [
            'name' => $role->name,
        ];

        foreach (Permission::all()->random(2) as $permission) {
            $attributes['role_' . $permission->slug] = $permission->id;
        }
        $response = $this->put(route('admin.roles.update', $role), $attributes);

        $response->assertStatus(302);
        $response->assertSessionHas("success", "Role Updated !");

        $this->assertDatabaseHas(Role::class, [
            'name' => $attributes['name'],
            'slug' => Str::slug($attributes['name']),
        ]);
    }

    public function testDestroyRole(): void
    {
        $this->authenticateUser(DefaultRoles::SUPER_ADMINISTRATOR);

        $role = Role::factory()->create();
        $this->assertDatabaseCount('roles', 4); // 1 user with factory and 3 defaults roles.

        $response = $this->delete(route('admin.roles.destroy', $role));

        $response->assertStatus(302);
        $this->assertModelMissing($role);
        $response->assertSessionHas("success", "Role Deleted !");
    }
}
