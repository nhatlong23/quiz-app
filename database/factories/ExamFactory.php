<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Exam;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exam>
 */
class ExamFactory extends Factory
{
    protected $model = Exam::class;
    protected static ?string $password;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'content' => $this->faker->text,
            'max_question' => $this->faker->randomDigitNot(0),
            'password' => static::$password ??= Hash::make('password'),
            'opening_time' => $this->faker->dateTime,
            'closing_time' => $this->faker->dateTime,
            'duration' => $this->faker->randomDigitNot(0),
            'subject_id' => $this->faker->randomDigitNot(0),
            'answer' => $this->faker->randomElement(['A', 'B', 'C', 'D']),
            'status' => $this->faker->randomElement([0, 1]),
        ];
    }
}
