<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AltNewToFresh extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tda_songs', function (Blueprint $table) {
            $table->renameColumn('new', 'fresh');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tda_songs', function (Blueprint $table) {
            $table->renameColumn('fresh', 'new');
        });
    }
}
