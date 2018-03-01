<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEdoAreaInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edo_area_infos', function (Blueprint $table) {
            $table->unsignedInteger('area');
            $table->string('name');
            $table->boolean('trial');
            $table->dateTime('freeBegin');
            $table->dateTime('freeEnd');
            $table->unsignedInteger('cntId');
            $table->unsignedInteger('ownId');

            $table->primary('area');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('edo_area_infos');
    }
}
