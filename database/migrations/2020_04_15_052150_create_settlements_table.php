<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettlementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settlements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('item_id')->nullable();
            $table->integer('course_id')->nullable();
            $table->string('payment_id', 100);
            $table->integer('price');
            $table->integer('settlement_fee')->comment('決済手数料（スクエア）3.25%'); 
            $table->integer('platform_fee')->comment('プラットフォーム手数料10%');
            $table->string('brand', 50);
            $table->string('last_4', 4);
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
        Schema::dropIfExists('settlements');
    }
}
