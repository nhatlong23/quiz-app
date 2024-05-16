<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Question;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    protected $model = Question::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subject_id' => $this->faker->randomDigitNot(0),
            'level_id' => $this->faker->randomDigitNot(0),
            'question' => $this->faker->text,
            'option1' => $this->faker->text,
            'option2' => $this->faker->text,
            'option3' => $this->faker->text,
            'option4' => $this->faker->text,
            'answer' => $this->faker->randomElement([1, 2, 3, 4]),
            'status' => $this->faker->randomElement([0, 1]),
        ];
    }
}
