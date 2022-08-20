<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
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
            'creator_id' => User::factory(),
            'name' => $this->faker->company,
            'doc_number' => $this->faker->unique()->cnpj,
        ];
    }

    protected function withFaker()
    {
        $faker = parent::withFaker();
        $faker->addProvider(
            new \Faker\Provider\pt_BR\Company(generator:$faker)
        );
        return $faker;
    }
}
