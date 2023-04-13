<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNullableExtendeduserinfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('extendedUserInfo', function($table) {
            $table->date('dateOfBirth')->nullable()->change();
            $table->integer('country')->nullable()->change(); //really needs to be int if i want to use to to match people
            $table->integer('location')->nullable()->change(); //really needs to be int if i want to use to to match people -> 'subindex' for provice based on country popup has to be dynamic
            $table->string('jobTitle')->nullable()->change(); //need some kind of nlp to match people on this.
            $table->integer('educationLevel')->nullable()->change();  //map prior
            $table->integer('gender')->nullable()->change(); //map prior
            $table->text('bio')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('extendedUserInfo', function($table) {
            $table->date('dateOfBirth')->change();
            $table->integer('country')->change(); //really needs to be int if i want to use to to match people
            $table->integer('location')->change(); //really needs to be int if i want to use to to match people -> 'subindex' for provice based on country popup has to be dynamic
            $table->string('jobTitle')->change(); //need some kind of nlp to match people on this.
            $table->integer('educationLevel')->change();  //map prior
            $table->integer('gender')->change(); //map prior
            $table->text('bio')->change();
        });
    }
}
