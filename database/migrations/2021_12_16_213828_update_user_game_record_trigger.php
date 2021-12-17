<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUserGameRecordTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE TRIGGER update_user_game_record_trigger AFTER INSERT ON user_game_history FOR EACH ROW 
            BEGIN
                DECLARE avg_score, ttl_win, ttl_loss INT;
                
                SELECT DISTINCT AVG(score) as avg_score,
                SUM(if(result = "win", 1, 0)) AS ttl_win,  
                Sum(if(result = "lose", 1, 0)) AS ttl_loss
                INTO avg_score, ttl_win, ttl_loss
                FROM user_game_history 
                where FK_uid = new.FK_uid
                group by FK_uid;
                
                UPDATE user_game_detail SET 
                average_score = avg_score,
                total_win = ttl_win,
                total_loss = ttl_loss
                WHERE FK_uid = new.FK_uid;
            END;
            ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('update_user_game_record_trigger');
    }
}
