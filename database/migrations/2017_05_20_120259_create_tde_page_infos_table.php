<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTdePageInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tde_page_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('page')->comment('页面编号');
            $table->unsignedInteger('itemId')->comment('显示项编号');
            $table->string('title')->comment('显示标题');
            $table->unsignedInteger('gameId')->comment('游戏编号')->nullable();
            $table->unsignedInteger('productId')->comment('商品统一编号.查询服务')->nullable();
            $table->unsignedInteger('prodId')->comment('商品统一编号.查询商店')->nullable();
            $table->string('url')->comment('项目调用地址')->nullable();
            $table->string('img')->comment('显示图片')->nullable();
            $table->unsignedTinyInteger('trial')->comment('状态标识');
            $table->string('biz')->comment('备注')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tde_page_infos');
    }
}
