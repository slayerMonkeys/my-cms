<?php

namespace Tests\Feature;

use App\Enums\DefaultRoles;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class TagsTest extends TestCase
{
    use WithFaker;

    public function testStoreTagWithPermissions(): void
    {

        $this->authenticateUser(DefaultRoles::SUPER_ADMINISTRATOR);

        $attributes = [
            'name' => $this->faker->unique()->name(),
        ];
        $response = $this->post(route('admin.tags.store'), $attributes);

        $response->assertStatus(302);
        $response->assertSessionHas("success", "Tag Created !");

        $this->assertDatabaseHas(Tag::class, [
            'name' => $attributes['name'],
            'slug' => Str::slug($attributes['name']),
        ]);
    }

    public function testStoreTagWithoutPermissions(): void
    {
        $this->authenticateUser();

        $attributes = [
            'name' => $this->faker->unique()->name(),
        ];
        $response = $this->post(route('admin.roles.store'), $attributes);
        $response->assertStatus(403);
    }

    public function testRenderTagIndex(): void
    {
        $this->authenticateUser(DefaultRoles::SUPER_ADMINISTRATOR);

        $tags = Tag::factory()->count(5)->create();

        $this->assertDatabaseCount('tags', 5);

        $response = $this->get(route('admin.tags.index'));

        $response->assertStatus(200);
        $response->assertSeeText($tags->pluck('name')->toArray());
    }

    public function testUpdateTag(): void
    {
        $this->authenticateUser(DefaultRoles::SUPER_ADMINISTRATOR);

        $tag = Tag::factory()->create();
        $this->assertDatabaseCount('tags', 1);

        $attributes = [
            'name' => $this->faker->unique()->name(),
        ];
        $response = $this->put(route('admin.tags.update', $tag), $attributes);

        $response->assertStatus(302);
        $response->assertSessionHas("success", "Tag Updated !");

        $this->assertDatabaseHas(Tag::class, [
            'name' => $attributes['name'],
            'slug' => Str::slug($attributes['name']),
        ]);
    }

    public function testDestroyTag(): void
    {
        $this->authenticateUser(DefaultRoles::SUPER_ADMINISTRATOR);

        $tag = Tag::factory()->create();
        $this->assertDatabaseCount('tags', 1); // 1 user with factory and 1 for auth.

        $response = $this->delete(route('admin.tags.destroy', $tag));

        $response->assertStatus(302);
        $this->assertModelMissing($tag);
        $response->assertSessionHas("success", "Tag Deleted !");
    }
}
