<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTdeUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tde_users', function (Blueprint $table) {
            $now = date('Y-m-d H:i:s');
            $table->dateTime('ownTD005')->comment('上次跳舞毯购买时间')->default($now);
            $table->dateTime('ownTD017')->comment('季度送毯到期时间')->default($now);
            $table->string('childLock')->comment('童锁')->default('');
            $table->integer('danceMat')->comment('历史购买跳舞毯次数')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tde_users', function (Blueprint $table) {
            $table->dropColumn('ownTD005');
            $table->dropColumn('ownTD017');
            $table->dropColumn('childLock');
            $table->dropColumn('danceMat');
        });
    }
}
