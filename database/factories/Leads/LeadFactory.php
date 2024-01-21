<?php

namespace Database\Factories\Leads;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Leads\Lead>
 */
class LeadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $internacionalization = ['BR', 'USA', 'EU'];
        // $status = ['novo', 'antigo', 'comprador', 'quase'];

        return [
            'name' => fake()->name(),
            'email' => fake()->freeEmail(),
            'internacionalization' => $internacionalization[rand(0,2)],
            'active' => fake()->boolean(),
            'annual_declaration' => fake()->boolean(),
            'status' => rand(1,5),
            'option' => rand(1,8),
            'exclusive' => fake()->boolean()
        ];
    }
}
