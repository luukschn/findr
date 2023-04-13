<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ExtendedUserInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extendedUserInfo', function (Blueprint $table) {
            // need to think about standardization in general

            //ensure id is same as users id
            $table->unsignedBigInteger('userId');
            $table->foreign('userId')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->date('dateOfBirth');
            $table->integer('country'); //really needs to be int if i want to use to to match people
            $table->integer('location'); //really needs to be int if i want to use to to match people -> 'subindex' for provice based on country popup has to be dynamic
            $table->string('jobTitle'); //need some kind of nlp to match people on this.
            $table->integer('educationLevel');  //map prior
            $table->integer('gender'); //map prior
            $table->text('bio');
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
        Schema::dropIfExists('extendedUserInfo');
    }
}
