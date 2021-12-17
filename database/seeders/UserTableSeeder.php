<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\User\User;
use App\Models\User\UserGameDetail;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        //Truncate the table "user" and "user_game_record"
        Schema::disableForeignKeyConstraints();
        User::truncate();
        UserGameDetail::truncate();
        Schema::enableForeignKeyConstraints();

        //create dump data into User
        User::factory(20)->create();
    }
}
