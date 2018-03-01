<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTdeTurntablePrizeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tde_turntable_prize', function (Blueprint $table) {
            $table->unsignedInteger('prizeID')->comment('奖品编号')->primary();
            $table->string('prizeName')->comment('奖品名称');
            $table->dateTime('date')->comment('修改时间');
            $table->string('prizeNum')->comment('奖品库存');
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
        Schema::dropIfExists('tde_turntable_prize');
    }
}
