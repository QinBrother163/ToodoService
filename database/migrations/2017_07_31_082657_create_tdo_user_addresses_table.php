<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTdoUserAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tdo_user_addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('userId');
            $table->unsignedInteger('retailId');
            $table->string('name');
            $table->string('phone');
            $table->string('address');
            $table->boolean('workday')->default(true);
            $table->timestamps();

            $table->unique(['userId', 'retailId']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tdo_user_addresses');
    }
}
