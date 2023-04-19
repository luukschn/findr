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
            $table->foreignId('userId')->nullable()->constrained('users', 'id')->cascadeOnDelete();
            $table->foreignId('scaleId')->nullable()->constrained('scales', 'scaleId')->cascadeOnDelete();
            $table->integer('score');
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
        Schema::dropIfExists('scaleResults');
    }
}
