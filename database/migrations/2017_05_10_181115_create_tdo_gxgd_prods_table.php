<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTdoGxgdProdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tdo_gxgd_prods', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('productId')->comment('产品编码');
            $table->string('goodsName')->comment('产品包名称');
            $table->unsignedSmallInteger('feeType')->comment('计费周期');
            $table->unsignedInteger('price')->comment('计费价格');
            $table->string('idcId')->comment('IDC产品ID');
            $table->string('bossId')->comment('BOSS产品ID');
            $table->string('tariffId')->comment('BOSS产品资费ID');
            $table->unsignedTinyInteger('env')->comment('测试环境');
            $table->boolean('verify')->comment('已审核');
            $table->string('pId')->comment('促销ID');
            $table->string('pName')->comment('促销名称');
            $table->string('pDesc')->comment('促销描述');
            $table->integer('pType');
            $table->string('pUnit');
            $table->string('pValue');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tdo_gxgd_prods');
    }
}
