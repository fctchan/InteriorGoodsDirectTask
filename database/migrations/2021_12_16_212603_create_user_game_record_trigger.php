<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateUserGameRecordTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::unprepared('
            CREATE TRIGGER insert_user_game_record_trigger AFTER INSERT ON user FOR EACH ROW 
                INSERT INTO user_game_detail (FK_uid, average_score, total_win, total_loss) VALUES (NEW.uid, 0, 0, 0)
            ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insert_user_game_record_trigger');
    }
}
