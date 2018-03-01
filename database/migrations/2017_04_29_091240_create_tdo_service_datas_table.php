<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTdoServiceDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tdo_service_datas', function (Blueprint $table) {
            $table->string('serialNo')->comment('开通服务序列号');
            $table->unsignedInteger('userId')->comment('用户编号');
            $table->string('retailId')->comment('渠道编号');
            $table->unsignedInteger('productId')->comment('商品统一编号');
            $table->string('goodsName')->comment('服务名称');
            $table->dateTime('beginTime')->comment('起始时间');
            $table->dateTime('endTime')->comment('到期时间');
            $table->timestamps();

            $table->primary('serialNo');
            $table->index('userId');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tdo_service_datas');
    }
}
