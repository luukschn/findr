<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateScoresTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scales', function (Blueprint $table) {
            $table->float('sourceAvg')->nullable()->change();
            $table->float('sourceSD')->nullable()->change();
            $table->float('resultsAvg')->nullable()->change();
            $table->float('resultsSD')->nullable()->change();
            $table->float('completedCount')->nullable()->change();
        });


        Schema::table('scaleResults', function (Blueprint $table) {
            $table->integer('score')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('scales', function (Blueprint $table) {
            $table->float('sourceAvg')->change();
            $table->float('sourceSD')->change();
            $table->float('resultsAvg')->change();
            $table->float('resultsSD')->change();
            $table->float('completedCount')->change();
        });

        Schema::table('scaleResults', function (Blueprint $table) {
            $table->integer('score')->change();
        });
    }
}
