<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GoalSettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => null,
            'goal_weight' => $this->faker->randomFloat(1, 45, 70),
        ];
    }
}
