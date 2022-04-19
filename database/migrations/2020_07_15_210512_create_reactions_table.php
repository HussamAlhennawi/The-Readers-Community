<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
//            $table->unsignedBigInteger('user_id');
//            $table->unsignedBigInteger('reaction_types_id');
            $table->timestamps();

//            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
//            $table->foreign('reaction_types_id')->references('id')->on('reaction_types')->onDelete('cascade');

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
        Schema::dropIfExists('reactions');
    }
}
