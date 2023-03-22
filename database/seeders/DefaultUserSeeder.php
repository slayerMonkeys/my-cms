<?php

namespace Database\Seeders;

use App\Enums\DefaultRoles;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DefaultUserSeeder extends Seeder
{
    public function run()
    {
        $superAdminUser = User::create([
            "name" => "the-super-administrator",
            "email" => "superadmin@my-cms.local",
            "password" => "superadmin123",
            "remember_token" => Str::random(10),
        ]);
        $adminUser = User::create([
            "name" => "the-administrator",
            "email" => "admin@my-cms.local",
            "password" => "admin123",
            "remember_token" => Str::random(10),
        ]);
        $user = User::create([
            "name" => "the-user",
            "email" => "user@my-cms.local",
            "password" => "user123",
            "remember_token" => Str::random(10),
        ]);

        $superAdminRole = Role::where("slug", DefaultRoles::SUPER_ADMINISTRATOR)->first();
        $adminRole = Role::where("slug", DefaultRoles::ADMINISTRATOR)->first();
        $userRole = Role::where("slug", DefaultRoles::USER)->first();

        $superAdminUser->roles()->attach($superAdminRole->id);
        $adminUser->roles()->attach($adminRole->id);
        $user->roles()->attach($userRole->id);
    }
}
