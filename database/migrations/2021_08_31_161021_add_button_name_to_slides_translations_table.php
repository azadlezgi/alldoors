<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddButtonNameToSlidesTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('slides_translations', function (Blueprint $table) {
            $table->string('button_url',255)->after('sub_title')->nullable();
            $table->string('button_name',255)->after('sub_title')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('slides_translations', function (Blueprint $table) {
            //
        });
    }
}
