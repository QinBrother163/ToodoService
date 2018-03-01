<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTdaSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tda_songs', function (Blueprint $table) {
            $table->unsignedInteger('songId')->primary();
            $table->integer('category');
            $table->string('title');
            $table->string('singer');
            $table->integer('long');
            $table->boolean('hot');
            $table->boolean('new');
            $table->boolean('suggest');
            $table->string('rhythm');
            $table->integer('grade');
            $table->integer('state');
            $table->boolean('verify');
            $table->unsignedInteger('user');
            $table->integer('score');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tda_songs');
    }
}
