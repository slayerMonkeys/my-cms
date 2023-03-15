<?php

namespace Tests\Feature;

use App\Enums\DefaultRoles;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use WithFaker;

    public function testStoreUserWithPermissions(): void
    {

        $this->authenticateUser(DefaultRoles::SUPER_ADMINISTRATOR);

        $attributes = [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => 'password',
            'password_confirmation' => 'password'
        ];

        foreach (Role::all()->random(2) as $role) {
            $attributes['role_' . $role->slug] = $role->id;
        }
        $response = $this->post('admin/users', $attributes);

        $response->assertStatus(302);
        $response->assertSessionHas("success", "User Created !");

        $this->assertDatabaseHas(User::class, [
            'name' => $attributes['name'],
            'email' => $attributes['email'],
        ]);
    }

    public function testStoreUserWithoutPermissions(): void
    {
        $this->authenticateUser();

        $attributes = [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => 'password',
            'password_confirmation' => 'password'
        ];

        foreach (Role::all()->random(2) as $role) {
            $attributes['role_' . $role->slug] = $role->id;
        }
        $response = $this->post('admin/users', $attributes);
        $response->assertStatus(403);
    }

    public function testRenderUserIndex(): void
    {
        $this->authenticateUser(DefaultRoles::SUPER_ADMINISTRATOR);

        $users = User::factory()->count(5)->create();

        $this->assertDatabaseCount('users', 6); // 5 users with factory and the authenticated user.

        $response = $this->get('/admin/users');

        $response->assertStatus(200);
        $response->assertSeeText($users->pluck('email')->toArray(), false);
    }

    public function testRenderUserProfile(): void
    {
        $this->authenticateUser(DefaultRoles::SUPER_ADMINISTRATOR);

        $user = User::factory()->hasRoles(3)->create();
        $this->assertDatabaseCount('roles', 6); // 3 role with factory and 3 default roles
        $this->assertModelExists($user);

        $response = $this->get('/admin/profile/' . $user->id);
        $response->assertStatus(200);

        $response->assertSeeText([...$user->only(['name', 'email']), ...$user->roles->only('name')]);
    }

    public function testRenderUserCreatePage(): void
    {
        $this->authenticateUser(DefaultRoles::SUPER_ADMINISTRATOR);

        $roles = Role::factory()->count(10)->create();
        $this->assertDatabaseCount('roles', 13); // 10 roles with factory and 3 default roles

        $response = $this->get('/admin/users/create');
        $response->assertStatus(200);

        $response->assertSeeText(['Name', ...$roles->only('name')]);
    }

    public function testRenderUserEditPage(): void
    {
        $this->authenticateUser(DefaultRoles::SUPER_ADMINISTRATOR);

        $user = User::factory()->create();
        $this->assertDatabaseCount('users', 2); // 1 user with factory and 1 for auth.
        $roles = Role::factory()->count(10)->create();
        $this->assertDatabaseCount('roles', 13); // 10 roles with factory and 3 default roles

        $response = $this->get('/admin/users/' . $user->id . '/edit');
        $response->assertStatus(200);

        $response->assertSeeText(['Name', 'Email', 'Roles', ...$roles->only('name')]);
    }

    public function testUpdateUser(): void
    {
        $this->authenticateUser(DefaultRoles::SUPER_ADMINISTRATOR);

        $user = User::factory()->create();
        $this->assertDatabaseCount('users', 2); // 1 user with factory and 1 for auth.
        $roles = Role::factory()->count(10)->create();
        $this->assertDatabaseCount('roles', 13); // 10 roles with factory and 3 default roles

        $attributes = [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
        ];

        foreach ($roles->random(2) as $role) {
            $attributes['role_' . $role->slug] = $role->id;
        }
        $response = $this->put('admin/users/' . $user->id, $attributes);

        $response->assertStatus(302);
        $response->assertSessionHas("success", "User Updated !");

        $this->assertDatabaseHas(User::class, [
            'name' => $attributes['name'],
            'email' => $attributes['email'],
        ]);
    }

    public function testDestroyUser(): void
    {
        $this->authenticateUser(DefaultRoles::SUPER_ADMINISTRATOR);

        $user = User::factory()->create();
        $this->assertDatabaseCount('users', 2); // 1 user with factory and 1 for auth.

        $response = $this->delete('admin/users/' . $user->id);

        $response->assertStatus(302);
        $this->assertDatabaseCount('users', 1);
        $response->assertSessionHas("success", "User Deleted !");
    }
}
