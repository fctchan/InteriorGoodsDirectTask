<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsergamedetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_game_detail', function (Blueprint $table) {
            $table->id('user_game_detail_id');
            $table->unsignedBigInteger('FK_uid')->nullable(false);;
            $table->foreign('FK_uid')->references('uid')->on('user')->onDelete('cascade');
            $table->integer('average_score');
            $table->integer('total_win');
            $table->integer('total_loss');
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
        Schema::dropIfExists('user_game_detail');
    }
}
