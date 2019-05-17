<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountingItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id'); //创建者的用户ID
            $table->string('catagory_code',4); //收入或者支出下的小类
            $table->string('catagory_name',100); //收入或者支出下的小类类名
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
        Schema::dropIfExists('accounting_items');
    }
}
