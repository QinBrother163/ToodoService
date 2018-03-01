<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTdeTurntableStateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tde_turntable_state', function (Blueprint $table) {
            $table->unsignedInteger('userID')->comment('用户编号')->primary();
            $table->unsignedInteger('freeStatus')->comment('免费状态 0:没有 1：有');
            $table->dateTime('freeDate')->comment('免费时间');
            $table->unsignedInteger('addNumber')->comment('额外次数');
            $table->dateTime('addNumberDate')->comment('额外时间');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tde_turntable_state');
    }
}
