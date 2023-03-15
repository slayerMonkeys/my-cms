<?php

namespace Tests\Feature;

use App\Enums\DefaultRoles;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostsTest extends TestCase
{
    use WithFaker;

    public function testStorePost(): void
    {

        $this->authenticateUser(DefaultRoles::SUPER_ADMINISTRATOR);

        $attributes = [
            'title' => $this->faker->unique()->sentence(),
            'body' => $this->faker->paragraphs(10, true),
            'tags' => Tag::factory()->count(3)->create()->pluck('id')->toArray(),
        ];
        $response = $this->post(route('admin.posts.store'), $attributes);

        $response->assertStatus(302);
        $response->dumpSession();
        $response->assertSessionHas("success", "Post Created !");

        $this->assertDatabaseHas(Post::class, [
            'title' => $attributes['title'],
            'body' => $attributes['body'],
        ]);

        $post = Post::where("title", $attributes['title'])->first();

        $this->assertDatabaseHas('post_tag', [
            'post_id' => $post->id,
            'tag_id' => $attributes['tags'][0]
        ]);
    }

    public function testRenderPostIndex(): void
    {
        $this->authenticateUser(DefaultRoles::SUPER_ADMINISTRATOR);

        $posts = Post::factory()->count(5)->create();
        $this->assertDatabaseCount('posts', 5);

        $response = $this->get(route('admin.posts.index'));

        $response->assertStatus(200);
        $response->assertSeeText($posts->only('title')->toArray());
    }

    public function testRenderPostShow(): void
    {
        $this->authenticateUser(DefaultRoles::SUPER_ADMINISTRATOR);

        $post = Post::factory()->create();
        $this->assertModelExists($post);

        $response = $this->get(route('posts.show', $post));
        $response->assertStatus(200);

        $response->assertSeeText($post->only(['title', 'body']));
    }

    public function testUpdatePost(): void
    {
        $this->authenticateUser(DefaultRoles::SUPER_ADMINISTRATOR);

        $post = Post::factory()->create();
        $this->assertDatabaseCount('posts', 1);

        $attributes = [
            'title' => $post->title,
            'body' => $this->faker->paragraphs(10, true),
            'tags' => Tag::factory()->count(3)->create()->pluck('id')->toArray(),
        ];

        $response = $this->put(route('admin.posts.update', $post), $attributes);
        $response->dumpSession();
        $response->assertStatus(302);
        $response->assertSessionHas("success", "Post Updated !");

        $this->assertDatabaseHas(Post::class, [
            'title' => $attributes['title'],
            'body' => $attributes['body'],
        ]);

        $this->assertDatabaseHas('post_tag', [
            'post_id' => $post->id,
            'tag_id' => $attributes['tags'][0]
        ]);
    }

    public function testDestroyPost(): void
    {
        $this->authenticateUser(DefaultRoles::SUPER_ADMINISTRATOR);

        $post = Post::factory()->create();
        $this->assertDatabaseCount('posts', 1);

        $response = $this->delete('admin/posts/' . $post->id);

        $response->assertStatus(302);
        $response->assertRedirect(route('admin.posts.index'));
        $this->assertModelMissing($post);
        $response->assertSessionHas("success", "Post Deleted !");
    }
}
