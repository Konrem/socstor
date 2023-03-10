<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function(Blueprint $table) {
            $table->increments('id');
            // $table->date('date');
            $table->tinyInteger('published');
            $table->string('title', 255);
            $table->text('text');
            $table->string('photo');
            $table->string('slug')->unique();
            $table->string('meta_description', 255);
            $table->string('meta_keywords', 255);
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
        Schema::dropIfExists('news');
    }
}
