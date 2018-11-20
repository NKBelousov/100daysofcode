<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTagsToMemes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memes_tags', function (Blueprint $table) {
            $table->integer('meme_id')->unsigned()->nullable();
            $table->foreign('meme_id')->references('id')
                  ->on('memes');
      
            $table->integer('tag_id')->unsigned()->nullable();
            $table->foreign('tag_id')->references('id')
                  ->on('tags');
      
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
        Schema::dropIfExists('memes_tags');
    }
}
