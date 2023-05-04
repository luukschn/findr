<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScaleInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scale_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('scaleId')->constrained('scales', 'scaleId');
            $table->string('internalName');
            $table->string('officialName');
            $table->string('reference');
            $table->string('explanation');
            $table->string('options'); //use as CSV to store different options
            $table->float('referenceMean');
            $table->float('referenceSD');
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
        Schema::dropIfExists('scale_information');
    }
}
