<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TagFactory extends Factory
{
    public function definition(): array
    {
        $tag = $this->faker->word();
        return [
            'name' => $tag,
            'slug' => Str::slug($tag)
        ];
    }
}
