<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTdoHnyxAssetOpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tdo_hnyx_asset_ops', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('op');
            $table->unsignedInteger('songId');
            $table->text('assetId');
            $table->string('code');
            $table->string('msg');
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tdo_hnyx_asset_ops');
    }
}
