<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id('uid');
            $table->string('username', 50)->unique();
            $table->string('tel', 20);
            $table->string('email', 100);
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
        Schema::dropIfExists('user');
    }
}
