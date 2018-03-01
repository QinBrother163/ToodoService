<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGdgdUserToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('personId')->comment('用户编号')->nullable();
            $table->unsignedInteger('stboxId')->comment('用户机顶盒编号')->nullable();
            $table->string('retailId')->comment('平台渠道编号')->nullable();
            $table->string('regionCode')->comment('区域编号')->nullable();
            $table->string('cardTV')->comment('机顶盒卡号')->nullable();
            $table->text('bizUser')->comment('业务用户信息')->nullable();

            $table->index('retailId');
            $table->index('cardTV');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex('retailId');
            $table->dropIndex('cardTV');

            $table->dropColumn('personId');
            $table->dropColumn('stboxId');
            $table->dropColumn('retailId');
            $table->dropColumn('regionCode');
            $table->dropColumn('cardTV');
            $table->dropColumn('bizUser');
        });
    }
}
