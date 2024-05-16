<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'student_code' => $this->faker->unique()->numerify('SV###'),
            'name' => $this->faker->name,
            'class_id' => $this->faker->randomDigitNotNull,
            'birth' => $this->faker->date,
            'gender' => $this->faker->randomElement(['male', 'female']),
            'cccd' => $this->faker->unique()->numerify('############'),
            'password' => static::$password ??= Hash::make('password'),
            'school_year' => $this->faker->year,
            'phone' => $this->faker->numerify('0#########'),
            'email' => $this->faker->unique()->safeEmail,
            'status' => $this->faker->randomElement([0, 1]),
        ];
    }
}
