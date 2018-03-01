<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTdoHnyxAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tdo_hnyx_assets', function (Blueprint $table) {
            $table->unsignedInteger('songId');
            $table->string('assetId');
            $table->text('otherSongs');
            $table->integer('online');
            $table->integer('verify');
            $table->string('videoId');
            $table->string('url');
            $table->timestamps();

            $table->primary('songId');
            $table->unique('assetId');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tdo_hnyx_assets');
    }
}
