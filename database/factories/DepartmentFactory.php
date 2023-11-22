<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Department>
 */
class DepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //$factory->define(Department::class, function (Faker $faker) {
        return [

            'department' => fake()->unique()->word,
            'status' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ];
        //});
    }
}
