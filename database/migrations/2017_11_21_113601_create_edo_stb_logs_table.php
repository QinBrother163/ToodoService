<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEdoStbLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edo_stb_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('userId');
            $table->timestamp('loginTime');
            $table->string('uid')->nullable();
            $table->string('model')->nullable();
            $table->string('type')->nullable();
            $table->integer('ram')->nullable();
            $table->string('os')->nullable();
            $table->string('gName')->nullable();
            $table->string('gVendor')->nullable();
            $table->string('gVersion')->nullable();
            $table->integer('gRam')->nullable();
            $table->boolean('gMt')->nullable();
            $table->string('gRt')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('edo_stb_logs');
    }
}
