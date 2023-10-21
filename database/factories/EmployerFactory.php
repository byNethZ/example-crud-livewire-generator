<?php

namespace Database\Factories;

use App\Models\Employer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EmployerFactory extends Factory
{
    protected $model = Employer::class;

    public function definition()
    {
        return [
			'name' => $this->faker->name,
			'email' => $this->faker->name,
        ];
    }
}
