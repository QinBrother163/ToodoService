<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEdoUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edo_users', function (Blueprint $table) {
            $table->unsignedInteger('userId')->comment('用户编号');
            $table->string('nickName')->comment('昵称');
            $table->string('passportId')->comment('账号');
            $table->string('retailId')->comment('渠道编号');
            $table->string('items')->comment('业务数据');//舍弃
            $table->string('bizContent')->comment('业务数据');//舍弃
            $table->text('ownProps')->comment('拥有物品的到期时间');
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
        Schema::dropIfExists('edo_users');
    }
}
