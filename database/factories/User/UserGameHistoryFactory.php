<?php

namespace Database\Factories\User;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User\User;
use App\Models\User\UserGameHistory;
use App\Models\GameRecord;

class UserGameHistoryFactory extends Factory
{
    protected $model = UserGameHistory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //'FK_uid' => $this->faker->randomElement(User::lists('uid')->toArray()),
            'FK_uid' => User::all()->random()->uid,
            'FK_game_record_id' => function () {
                return factory(GameRecord::class)->create()->game_record_id;
            },
            'result' => $this->faker->randomElement(['win', 'lose']),
            'score' => $this->faker->numberBetween(0,100),
        ];
    }
}
