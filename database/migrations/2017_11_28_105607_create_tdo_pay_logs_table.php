<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTdoPayLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tdo_pay_logs', function (Blueprint $table) {
            $table->string('tradeNo');
            $table->unsignedInteger('userId');
            $table->string('retailId');
            $table->text('biz');
            $table->timestamp('created_at');

            $table->primary('tradeNo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tdo_pay_logs');
    }
}
