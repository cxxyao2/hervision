<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePolljsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polljs', function (Blueprint $table) {
            $table->increments('id');
            //$table->integer('post_id')->unsigned()->index();//对应的post是哪一个,添加1个索引
            $table->string('title'); //标题
            $table->text('content'); //投票目的说明
            for($i=1;$i<=10;$i++){
              $table->string('option'.$i)->nullable(); //分支名字
              $table->integer('option_votes'.$i)->nullable();  //分支票数
            }
           $table->integer('single_mul')->default(0); //0-单选  1-多选
           $table->integer('mul_maxnum')->default(1); //多选时最多选择几个
           $table->dateTime('end_time')->default(Carbon\Carbon::now()); //投票截止时间
           $table->integer('user_id'); //创建者的用户ID
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
        Schema::dropIfExists('polljs');
    }
}
