<?php

namespace Database\Factories\User;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User\User;

class UserFactory extends Factory
{
    protected $model = User::class;
    
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gender = $this->faker->randomElement(['male', 'female']);

        return [
            'username' => $this->faker->unique()->name($gender),
            'tel' => $this->faker->numerify('###########'),
            'email' => $this->faker->unique()->safeEmail(),
        ];
    }

}
