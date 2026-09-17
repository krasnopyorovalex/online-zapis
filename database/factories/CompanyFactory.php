<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Attributes\UseModel;
use Illuminate\Database\Eloquent\Factories\Factory;

#[UseModel(Company::class)]
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'inn' => $this->faker->unique()->regexify('\d{10,12}'),
            'logo' => $this->faker->md5(),
            'is_active' => (bool) $this->faker->numberBetween(0, 1),
        ];
    }
}
