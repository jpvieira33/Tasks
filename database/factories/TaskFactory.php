<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category = Category::all()->random();

        return [
            'title'=> fake()->text(30),
            'description'=> fake()->text(60),
            'due_date'=> fake()->dateTime(),
            'user_id'=> $category->user_id,
            'category_id'=> $category,
        ];
    }
}
