<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameIdColumnsToId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->renameColumn('uid', 'id');
        });

        Schema::table('user_game_details', function(Blueprint $table) {
            $table->renameColumn('user_game_detail_id', 'id');
            $table->renameColumn('FK_uid', 'user_id');
        });

        Schema::table('user_game_histories', function(Blueprint $table) {
            $table->renameColumn('user_game_history_id', 'id');
            $table->renameColumn('FK_uid', 'user_id');
            $table->renameColumn('FK_game_record_id', 'game_record_id');
        });

        Schema::table('game_records', function(Blueprint $table) {
            $table->renameColumn('game_record_id', 'id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('id', function (Blueprint $table) {
            //
        });
    }
}
