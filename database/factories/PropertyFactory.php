<?php

namespace Database\Factories;

use App\Models\Owner;
use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    protected $model = Property::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $owners = Owner::count();
        
        return [
            'property_name' => fake()->name(),
            'location' => fake()->address(),
            'price' => fake()->numberBetween(10000,20000),
            'monthly' => fake()->numberBetween(100,500),
            'yearly' => fake()->numberBetween(1000,3000),
            'status' => 'vacant',
            'owner_id' => fake()->numberBetween(1, $owners),
        ];
    }
}