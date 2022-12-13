<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionsValuesTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options_values_translations', function (Blueprint $table) {
            $table->bigInteger('option_value_id')->unsigned();
            $table->bigInteger('language_id')->unsigned();
            $table->string('text')->nullable();
            $table->timestamps();

            $table->foreign('option_value_id')
                ->references('id')
                ->on('options_values')
                ->onDelete('cascade');


            $table->foreign('language_id')
                ->references('id')
                ->on('languages')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('options_values_translations');
    }
}
