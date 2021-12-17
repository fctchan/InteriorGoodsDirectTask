<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\GameRecord;

class GameRecordFactory extends Factory
{
    protected $model = GameRecord::class;

    /**
     * Define Game Record.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'game_date' => $this->faker->dateTimeThisYear('+2 months'),
        ];
    }

}
