<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100);
            $table->unsignedInteger('user_id');
            $table->string('detail', 1000)->nullable();
            $table->integer('price');
            $table->string('path')->nullable();
            $table->string('image_path')->nullable();
            $table->dateTime('video_time')->nullable();
            $table->unsignedInteger('course_id')->nullable();
            $table->unsignedInteger('course_order')->nullable();
            $table->unsignedinteger('preview_id')->nullable();
            $table->integer('preview_flg')->default(0);
            $table->integer('release_flg')->default(0);
            $table->integer('convert_flg')->default(0);
            $table->integer('pre_convert_flg')->default(0);
            $table->integer('delete_flg')->default(0);
            $table->integer('free_flg')->default(0);
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
        Schema::dropIfExists('items');
    }
}
