<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTdeTurntableProbabilityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tde_turntable_probability', function (Blueprint $table) {
            $table->unsignedInteger('userType')->comment('用户类型')->primary();
            $table->float('onePro')->comment('一等奖几率');
            $table->float('twoPro')->comment('二等奖几率');
            $table->float('threePro')->comment('三等奖几率');
            $table->float('fourPro')->comment('四等奖几率');
            $table->float('fivePro')->comment('五等奖几率');
            $table->float('sixPro')->comment('六等奖几率');
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
        Schema::dropIfExists('tde_turntable_probability');
    }
}
