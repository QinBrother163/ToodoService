<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTdeTurntableWinningTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tde_turntable_winning', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('订单编号');
            $table->unsignedInteger('userID')->comment('用户编号');
            $table->string('userName')->comment('用户名字');
            $table->unsignedInteger('prizeID')->comment('奖品编号');
            $table->string('prizeName')->comment('奖品名称');
            $table->dateTime('winningDate')->comment('中奖时间');
            $table->unsignedInteger('state')->comment('中奖状态 1:未领取 2：已领取 3：已过期');
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
        Schema::dropIfExists('tde_turntable_winning');
    }
}
