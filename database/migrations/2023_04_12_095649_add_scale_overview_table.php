<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddScaleOverviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scales', function(Blueprint $table) {
            $table->id('scaleId');
            $table->string('internalName');
            $table->string('officialName');
            $table->string('reference');
            $table->string('explanation')->nullable();
            $table->string('options'); //use as CSV to store different options
            $table->float('referenceMean');
            $table->float('referenceSD');
            $table->float('resultsAvg')->nullable();
            $table->float('resultsSD')->nullabe();
            $table->integer('completedCount')->default(0);
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
        Schema::dropIfExists('scales');
    }
}
