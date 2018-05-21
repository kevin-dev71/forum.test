<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedInteger('forum_id');
            $table->foreign('forum_id')->references('id')->on('forums');
            $table->string('title');
            $table->string('slug');
            $table->index('slug');
            $table->text('description');
            $table->string('attachment')->nullable();
            $table->timestamps();
        });

        /* Para Actualizar las tablas
         *
         * Schema::table('posts' , function (Blueprint $table){
            $table->string('slug');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
