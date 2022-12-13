<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsModelsTranslationsListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_models_lists', function (Blueprint $table) {
            $table->bigInteger('product_id')->unsigned();
            $table->bigInteger('model_id')->unsigned();
            $table->timestamps();

            $table->foreign('model_id')
                ->references('id')
                ->on('products_models')
                ->onDelete('cascade');

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
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
        Schema::dropIfExists('products_models_lists');
    }
}
