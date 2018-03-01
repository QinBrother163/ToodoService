<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTdoGxgdAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tdo_gxgd_assets', function (Blueprint $table) {
            $table->unsignedInteger('songId');
            $table->string('assetId');
            $table->text('otherSongs');
            $table->integer('online');
            $table->integer('verify');
            $table->string('videoId');
            $table->string('indexId');
            $table->string('mediaId');
            $table->string('originalId');
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
        Schema::dropIfExists('tdo_gxgd_assets');
    }
}
