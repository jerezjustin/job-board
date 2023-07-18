<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'title' => $title = fake()->unique()->jobTitle,
            'slug' => str()->slug($title),
            'company' => fake()->company,
            'location' => fake()->country,
            'contract_type' => fake()->randomElement(['Full-Time', 'Part-Time']),
            'content' => fake()->randomHtml(),
            'is_active' => true,
            'apply_link' => fake()->url,
            'salary' => fake()->numberBetween('50000', '250000'),
            'user_id' => User::all()->random()->id
        ];
    }
}
