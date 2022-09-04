<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewingHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('viewing_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('viewed_at');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('item_id')->nullable();
            $table->integer('count')->default(1);
            $table->unsignedInteger('couse_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('viewing_histories');
    }
}
