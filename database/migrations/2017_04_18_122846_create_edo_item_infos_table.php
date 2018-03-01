<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEdoItemInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edo_item_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('page')->comment('分页编号');
            $table->string('itemName')->comment('信息标题');
            $table->integer('itemId')->comment('关联项目编号');
            $table->integer('itemType')->comment('项目类型');
            $table->string('itemPicture')->comment('项目图片');
            $table->integer('pictureType')->comment('图片类型');
            $table->string('itemDescription')->comment('项目描述');
            $table->integer('operateType')->comment('游戏操作模式');
            $table->integer('propId')->comment('单次进入游戏的费用');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('edo_item_infos');
    }
}
