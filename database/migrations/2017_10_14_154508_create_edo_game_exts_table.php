<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEdoGameExtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edo_game_exts', function (Blueprint $table) {
            $table->integer('gameId');
            $table->string('gameName');
            $table->string('gameNameCn');
            $table->integer('gameType');
            $table->string('packageName');
            $table->string('startActivityName');
            $table->string('takeHandType');
            $table->integer('freePlayTime');
            $table->integer('playCount');
            $table->integer('gameHint');
            $table->string('infraredPicture');
            $table->string('handPicture');

            $table->primary('gameId');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('edo_game_exts');
    }
}
