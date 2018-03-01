<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTdoGoodsInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tdo_goods_infos', function (Blueprint $table) {
            $table->increments('productId')->comment('统一商品编号');
            $table->string('goodsId')->comment('商家自编号');
            $table->string('goodsName')->comment('商品名称');
            $table->string('goodsDesc')->comment('商品描述')->nullable();
            $table->boolean('complex')->comment('是复合产品');
            $table->string('comment')->comment('复合内容');
            $table->unsignedTinyInteger('category')->comment('产品类型');
            $table->integer('price')->comment('定价/分');
            $table->integer('storeId')->comment('商家编号');
            $table->string('storeName')->comment('商家名称');
            $table->boolean('verify')->comment('已审核');
            $table->string('note')->comment('备注')->nullable();

            $table->unique(['storeId', 'goodsId']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tdo_goods_infos');
    }
}
