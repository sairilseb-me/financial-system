<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $gender = ['Male','Female'];
        $selectedGender = $gender[random_int(0,1)];
        
        return [
            'id' => $this->faker->uuid(),
            'first_name' => $this->faker->firstName(),
            'middle_name' => $this->faker->lastName(),
            'last_name' => $this->faker->lastName(),
            'date_of_birth' => $this->faker->date(),
            'gender' => $selectedGender,
            'barangay' => $this->faker->streetAddress(),
            'municipality' => $this->faker->city(),
            'province' => $this->faker->state(),
        ];
    }
}
