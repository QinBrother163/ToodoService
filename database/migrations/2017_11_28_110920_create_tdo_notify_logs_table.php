<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTdoNotifyLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tdo_notify_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('retailId');
            $table->string('method');
            $table->text('bizIn');
            $table->text('bizOut');
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
        Schema::dropIfExists('tdo_notify_logs');
    }
}
