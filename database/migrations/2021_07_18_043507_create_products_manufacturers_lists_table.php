<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsManufacturersListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_manufacturers_lists', function (Blueprint $table) {
            $table->bigInteger('product_id')->unsigned();
            $table->bigInteger('manufacturer_id')->unsigned();
            $table->timestamps();

            $table->foreign('manufacturer_id')
                ->references('id')
                ->on('products_manufacturers')
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
        Schema::dropIfExists('products_manufacturers_lists');
    }
}
