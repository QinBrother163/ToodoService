<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTdeUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tde_users', function (Blueprint $table) {
            $table->unsignedInteger('userId')->comment('用户编号');
            $table->string('nick')->comment('昵称');
            $table->unsignedInteger('coins')->comment('金币余额');
            $table->unsignedInteger('hisCoins')->comment('历史总额');
            $table->text('biz')->comment('业务信息');
            $table->dateTime('ownTD003')->comment('跳舞包月到期时间');
            $table->dateTime('ownTD011')->comment('半年送毯到期时间');

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
        Schema::dropIfExists('tde_users');
    }
}
