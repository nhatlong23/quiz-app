<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Classs;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Classs>
 */
class ClasssFactory extends Factory
{
    protected $model = Classs::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'desc' => $this->faker->text,
            'block_id' => $this->faker->randomDigitNot(0),
            'number' => $this->faker->randomDigitNot(0),
            'status' => $this->faker->randomElement([0, 1]),
        ];
    }
}
