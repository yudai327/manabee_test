<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100);
            $table->unsignedInteger('user_id');
            $table->string('detail', 1000)->nullable();
            $table->integer('price')->default(0);
            $table->dateTime('create_at');
            $table->unsignedinteger('category_1');
            $table->unsignedinteger('category_2');
            $table->unsignedinteger('parent_id')->nullable();
            $table->unsignedinteger('section_order')->nullable();
            $table->integer('delete_flg')->default(0);
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
        Schema::dropIfExists('courses');
    }
}
