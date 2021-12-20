<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\GameRecord;
use App\Models\User\UserGameHistory;

class GameRecordTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Truncate the table "game_record" and "user_game_history"
        Schema::disableForeignKeyConstraints();
        GameRecord::truncate();
        UserGameHistory::truncate();
        Schema::enableForeignKeyConstraints();

        //create dump data into game_record and user_game_history (create 1 record in game_record, 2 records will be created in user_game_history)
        GameRecord::factory(300)->create()->each(function(GameRecord $gameRecord){
            UserGameHistory::factory(2)->create(['game_record_id' => $gameRecord]);
        });
    }
}
