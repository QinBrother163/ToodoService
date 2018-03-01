<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTdaRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tda_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('songId');
            $table->unsignedInteger('userId');
            $table->integer('score');
            $table->integer('combo');
            $table->float('perfect');
            $table->integer('eval');
            $table->float('calorie');

            $table->index('userId');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tda_records');
    }
}
