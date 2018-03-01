<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTdcRowInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tdc_row_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('docker');
            $table->tinyInteger('subject');
            $table->tinyInteger('body');
            $table->integer('width');
            $table->integer('height');
            $table->integer('padding');
            $table->integer('spacing');
            $table->integer('count');
            $table->string('span')->nullable();
            $table->string('slots')->nullable();
            $table->string('imgs')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tdc_row_infos');
    }
}
