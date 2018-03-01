<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTdoUnicomProdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tdo_unicom_prods', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('productId');
            $table->string('goodsName');
            $table->unsignedSmallInteger('feeType');
            $table->unsignedInteger('price');
            $table->string('idcId');
            $table->unsignedTinyInteger('env')->comment('测试环境');
            $table->boolean('verify')->comment('已审核');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tdo_unicom_prods');
    }
}
