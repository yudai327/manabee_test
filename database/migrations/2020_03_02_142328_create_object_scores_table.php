<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjectScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('object_scores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('score')->nullable();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('item_id');
            $table->string('comment', 200)->nullable();
            $table->integer('reply_id')->nullable();
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
        Schema::dropIfExists('object_scores');
    }
}
