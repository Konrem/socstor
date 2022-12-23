<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMainBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_blocks', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255)->nullable();
            $table->string('img', 200)->nullable();
            $table->text('text');
            $table->string('link', 100)->nullable();
            $table->boolean('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('main_blocks');
    }
}
