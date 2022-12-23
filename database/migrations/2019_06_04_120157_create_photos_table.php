<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function(Blueprint $table) {
            $table->increments('id');
            $table->string('photo', 200);
            
            $table->unsignedInteger('albums_id')->nullable();
            $table->foreign('albums_id')->references('id')->on('albums')
            ->onDelete('cascade');

            $table->unsignedInteger('sliders_id')->nullable();
            $table->foreign('sliders_id')->references('id')->on('sliders')
            ->onDelete('cascade');

            $table->unsignedInteger('news_id')->nullable();
            $table->foreign('news_id')->references('id')->on('news')->onDelete('cascade');

        //     $table->unsignedInteger('cover_id')->unsigned()->index();
        //     $table->foreign('cover_id')->references('cover')->on('news')
        //     ->onDelete('cascade');
        });
    }

    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('photos', function(Blueprint $table) {
        //     $table->dropForeign('photos_cover_id_foreign');
        //     $table->dropColumn('cover_id');
        // });

        Schema::dropIfExists('photos');
    }
}
