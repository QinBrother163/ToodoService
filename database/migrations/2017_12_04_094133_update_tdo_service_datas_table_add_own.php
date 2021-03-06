<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTdoServiceDatasTableAddOwn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tdo_service_datas', function (Blueprint $table) {
            $table->string('tradeNo')->nullable();
            $table->boolean('own')->default(false);
            $table->timestamp('ownTime')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tdo_service_datas', function (Blueprint $table) {
            $table->dropColumn('tradeNo');
            $table->dropColumn('own');
            $table->dropColumn('ownTime');
        });
    }
}
