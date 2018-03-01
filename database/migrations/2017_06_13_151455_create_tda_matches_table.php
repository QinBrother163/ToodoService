<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTdaMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tda_matches', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('songId');
            $table->text('records');
            $table->dateTime('beginTime');
            $table->dateTime('endTime');
            $table->unsignedInteger('last');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tda_matches');
    }
}
