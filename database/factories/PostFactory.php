<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Models\Post;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $factory->define(Post::class, function (Faker $faker) {
            return [
                'imageUrl' => $faker->imageUrl(),
                'name' => $faker->name,
                'job_title' => $faker->jobTitle,
                'line_manager' => '@' . $faker->userName,
                'department' => $faker->word,
                'Office' => $faker->company,
                'employee_status' => $faker->randomElement(['ACTIVE', 'NOT ACTIVE']),
                'account' => $faker->randomElement(['Activated', 'Deactivated']),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        });
    }
}
