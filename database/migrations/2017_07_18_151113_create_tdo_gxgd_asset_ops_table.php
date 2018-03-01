<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTdoGxgdAssetOpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tdo_gxgd_asset_ops', function (Blueprint $table) {
            $table->bigIncrements('opId');
            $table->string("id")->comment('媒资注入ID');
            $table->string("msg_id")->comment('消息id');
            /**
             * 媒资类型：
             * vod:主媒资
             * index:分集
             * media:片源
             */
            $table->string("type");
            /**
             * 0表示审核
             * 1表示上下线
             * 2表示注入（修改+新增）结果
             * 3表示注入（删除）结果
             */
            $table->string("opt_type");
            $table->string("cp_id");
            /**
             * 结果
             * opt_type值 说明
             * 0 0：通过审核
             *   1：取消审核（待审核）
             *   3：未通过审核
             * 1 0：上线
             *   1：下线
             * 2 0：注入（修改+新增）成功
             *   1：注入（修改+新增）失败
             * 3 0：注入（ ）成功 删除
             *   1：注入（ ）失败
             */
            $table->string("status");
            /**
             * 操作时间 2017-01-01 12:00:00
             */
            $table->dateTime('create_time');
            $table->string("summary");
            $table->string("nns_id");
            /**
             * 是否真正同步下线，0表示同步下线操作，1表示不同步下线操作
             */
            $table->string("is_sync");
            $table->string("original_id");
            $table->string("sync_time");
            $table->string("code")->default('0');
            $table->string("msg")->default('处理成功');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tdo_gxgd_asset_ops');
    }
}
