<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTdaUsersTableAddMatchs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tda_users', function (Blueprint $table) {
            $table->text('matchs')->comment('最近比赛得分');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tda_users', function (Blueprint $table) {
            $table->dropColumn('matchs');
        });
    }
}
