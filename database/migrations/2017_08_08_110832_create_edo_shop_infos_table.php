<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEdoShopInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edo_shop_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('page');
            $table->string('title');
            $table->string('desc');
            $table->string('img');
            $table->integer('imgType');
            $table->integer('operateType');
            $table->integer('trial');
            $table->integer('itemId');
            $table->integer('itemType');
            $table->integer('productId');
            $table->integer('prodId');
            $table->string('biz');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('edo_shop_infos');
    }
}
