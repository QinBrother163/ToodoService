<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEdoCallGameLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edo_call_game_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userId')->comment('用户编号');
            $table->integer('gameId')->comment('游戏编号');
            $table->integer('versionCode')->comment('游戏版本序号');
            $table->dateTime('time')->comment('操作时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('edo_call_game_logs');
    }
}
