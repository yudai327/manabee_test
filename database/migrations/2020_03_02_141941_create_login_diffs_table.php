<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoginDiffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('login_diffs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mail', 255);
            $table->string('fb_id', 20)->nullable();
            $table->string('tw_id', 20)->nullable();
            $table->string('goo_id', 20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('login_diffs');
    }
}
