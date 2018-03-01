<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTdoBillLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tdo_bill_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('userId');
            $table->string('retailId');
            $table->string('tradeNo');
            $table->integer('productId');
            $table->string('subject');
            $table->integer('logType');
            $table->integer('amount');
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tdo_bill_logs');
    }
}
