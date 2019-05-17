<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePollRecordjsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poll_recordjs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pollj_id')->unsigned()->index();//对应的vote是哪一个,添加1个索引
           $table->integer('user_id'); //投票人
           $table->string('optionid');//分支名字
           $table->integer('approve_disa')->default(1);//1:支持 0:反对 默认支持
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poll_recordjs');
    }
}
