<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEdoGameInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edo_game_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('gameId')->comment('游戏编号');
            $table->string('gameName')->comment('游戏名称');
            $table->string('gameNameCn')->comment('中文名');
            $table->string('gameDescription')->comment('游戏简介');
            $table->integer('gameType')->comment('"游戏类型');
            $table->string('packageName')->comment('java包名');
            $table->integer('versionCode')->comment('版本号');
            $table->string('gameUrl')->comment('主程序文件');
            $table->string('gameVersion')->comment('bin版本');
            $table->integer('gameSize')->comment('bin大小/kb');
            $table->string('resUrl')->comment('资源地址');
            $table->string('resVersion')->comment('res版本');
            $table->integer('resSize')->comment('res大小/kb');
            $table->dateTime('updateTime')->comment('更新时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('edo_game_infos');
    }
}
