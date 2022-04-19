<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscussionMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discussion_members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('discussion_id');
            $table->unsignedBigInteger('user_id');
            $table->boolean('active')->default(1);
            $table->timestamps();

            $table->foreign('discussion_id')->references('id')->on('discussions')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('discussion_members');
    }
}
