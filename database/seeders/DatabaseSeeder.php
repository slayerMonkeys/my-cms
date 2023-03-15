<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('permissions')->truncate();
        DB::table('roles')->truncate();
        DB::table('role_user')->truncate();
        DB::table('permission_role')->truncate();
        DB::table('users')->truncate();
        DB::table('posts')->truncate();
        DB::table('tags')->truncate();
        DB::table('post_tag')->truncate();

        $users = User::factory()
            ->count(50)
            ->hasPosts(10)
            ->create();
        Tag::factory(50)->create();

        foreach ($users as $user) {
            foreach ($user->posts as $post) {
                $tags = Tag::pluck("id", "name")->random(random_int(1, 5))->toArray();
                $post->tags()->attach($tags);
            }
        }

        $this->call([
            PermissionsSeeder::class,
            DefaultRolesSeeder::class,
            DefaultUserSeeder::class
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
