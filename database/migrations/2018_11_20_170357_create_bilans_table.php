<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBilansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bilans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id'); //创建者的用户ID
            $table->date('bilan_day');   //发生日期
            $table->string('inout_flag'); //收入0 支出1
            $table->string('catagory_code',4); //收入或者支出下的小类
            $table->decimal('item_amount',10,2)->default(0); //金额到千万级别
            $table->string('item_details',100)->default(' '); //补充说明
            $table->unsignedInteger('visible_level')->default(0); //0-全员可见 1-好友可见 2-自己可见
            $table->unsignedInteger('can_comment') ->default(0); //0-能评论 1-不能评论
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
        Schema::dropIfExists('bilans');
    }
}
