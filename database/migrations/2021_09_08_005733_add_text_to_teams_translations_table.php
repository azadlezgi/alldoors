<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTextToTeamsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teams_translations', function (Blueprint $table) {
            $table->text('description')->after('name')->nullable();
            $table->string('keyword')->after('name')->nullable();
            $table->string('title')->after('name')->nullable();
            $table->text('text')->after('name')->nullable();



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teams_translations', function (Blueprint $table) {
            //
        });
    }
}
