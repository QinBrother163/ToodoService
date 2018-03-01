<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTdoHnyxBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tdo_hnyx_bills', function (Blueprint $table) {
            $table->unsignedInteger('userId');
            $table->text('ownBills');
            $table->timestamps();
            
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
        Schema::dropIfExists('tdo_hnyx_bills');
    }
}
