<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTdaUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tda_users', function (Blueprint $table) {
            $table->unsignedInteger('userId');
            $table->text('records');
            $table->float('calorie');
            $table->float('lastCalorie');
            $table->float('hisCalorie');

            $table->primary('userId');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tda_users');
    }
}
