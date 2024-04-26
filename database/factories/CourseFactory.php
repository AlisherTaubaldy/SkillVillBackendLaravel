<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = FakerFactory::create();

        return [
            'title' => $faker->sentence(4),
            'description' => $faker->paragraphs(3, true),
            'imageUrl' => $faker->imageUrl(640, 480), // Adjust image dimensions if needed
            'price' => $faker->randomFloat(2, 10, 200), // Creates random price between 10 and 200 with 2 decimal places
            'rating' => $faker->numberBetween(1, 5),
            'category_id' => rand(1,10), // Replace with your category model path
        ];
    }
}
