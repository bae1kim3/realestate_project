<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\S_info>
 */
class S_infoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        $date = $this->faker->dateTimeBetween('-1 years');
        $s_type = $this->faker->randomElement(['매매', '월세', '전세']);
        $s_size = $this->faker->numberBetween(1, 100);
        return [
            'u_no' => 5
            ,'s_name' => $this->faker->realText(10)
            ,'s_add' => '동구 팔공산로2길 16'
            ,'s_type' => $s_type
            ,'s_size' => $s_size
            ,'s_stai' => '감삼'
            ,'s_fl' => $this->faker->numberBetween(1, 10)
            ,'s_log' => 35.9945411435551
            ,'s_lat' => 128.61081323131
            ,'p_deposit' =>$this->faker->numberBetween(1, 100)
            ,'p_month' => $this->faker->numberBetween(1, 100)
            ,'animal_size' => $this->faker->randomElement(['0','1'])
            ,'created_at' => $date
            ,'updated_at' => $date
        ];
    }
}
