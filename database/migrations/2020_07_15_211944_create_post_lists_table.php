<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('listas_id');
            $table->unsignedBigInteger('post_id');
            $table->boolean('active')->default(1);
            $table->timestamps();

            $table->foreign('listas_id')->references('id')->on('listas')->onDelete('cascade');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');

            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_lists');
    }
}
