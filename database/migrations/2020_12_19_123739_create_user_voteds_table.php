<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserVotedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_voteds', function (Blueprint $table) {
            $table->id();
            $table->ipAddress('ip');
            $table->foreignid('option_id');
            $table->foreign('option_id')->references('id')->on('options')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignid('vote_id');
            $table->foreign('vote_id')->references('id')->on('votes')->onDelete('cascade')->onUpdate('cascade');
            $table->unique(['ip','vote_id']);
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
        Schema::dropIfExists('user_voteds');
    }
}
