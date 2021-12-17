<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsergamehistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_game_history', function (Blueprint $table) {
            $table->id('user_game_history_id');
            $table->unsignedBigInteger('FK_uid')->nullable(false);
            $table->foreign('FK_uid')->references('uid')->on('user')->onDelete('cascade');
            $table->unsignedBigInteger('FK_game_record_id')->nullable(false);
            $table->foreign('FK_game_record_id')->references('game_record_id')->on('game_record')->onDelete('cascade');
            $table->string('result', 10);
            $table->integer('score');
            $table->dateTime('create_date')->useCurrent();
            $table->string('create_by', 50)->default('System');
            $table->dateTime('last_update_date')->useCurrent();
            $table->string('last_update_by', 50)->default('System');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_game_history');
    }
}
