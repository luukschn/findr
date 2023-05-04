<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScaleQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scale_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('scaleId')->constrained('scales', 'scaleId');
            $table->integer('format'); //0 normal, -1 reversed 
            $table->string('question_text');
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
        Schema::dropIfExists('scale_questions');
    }
}
