<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddScaleResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scaleResults', function(Blueprint $table){
            $table->id('resultId');
            $table->foreignId('userId')->constrained('users', 'id');
            $table->foreignId('scaleId')->constrained('scales', 'scaleId');
            $table->integer('score');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scaleResults');
    }
}
