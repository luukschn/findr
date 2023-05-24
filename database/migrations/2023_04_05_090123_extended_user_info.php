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
            // $table->id();
            // $table->foreign('user_id')->constrained('users', 'id')->cascadeOnDelete();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->date('dateOfBirth')->nullable();
            $table->integer('country')->nullable(); //really needs to be int if i want to use to to match people
            $table->integer('location')->nullable(); //really needs to be int if i want to use to to match people -> 'subindex' for provice based on country popup has to be dynamic
            $table->string('jobTitle')->nullable(); //need some kind of nlp to match people on this.
            $table->integer('educationLevel')->nullable();  //map prior
            $table->integer('gender')->nullable(); //map prior
            $table->text('bio')->nullable();
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
