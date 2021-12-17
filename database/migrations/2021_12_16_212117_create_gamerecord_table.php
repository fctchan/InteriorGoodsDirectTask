<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamerecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_record', function (Blueprint $table) {
            $table->id('game_record_id');
            $table->dateTime('game_date')->useCurrent();
            $table->dateTime('create_date')->useCurrent();
            $table->string('create_by', 50)->default('System');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_record');
    }
}
