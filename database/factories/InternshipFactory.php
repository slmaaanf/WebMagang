<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Internship;

class InternshipFactory extends Factory
{
    protected $model = Internship::class;

    public function definition()
    {
        return [
            'title' => $this->faker->jobTitle,
            'company' => $this->faker->company,
            'description' => $this->faker->paragraph,
            'requirements' => $this->faker->paragraph,
            'qualification' => $this->faker->paragraph,
            'start_date' => now(),
            'end_date' => now()->addMonths(3),
        ];
    }
}
