<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FAQuestions>
 */
class FAQuestionsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'question' => fake()->title(),
            'answer' => fake()->text(20),
            'f_a_q_categories_id' => 1,
        ];
    }
}
