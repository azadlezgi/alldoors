<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsSpecialsPricesListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_specials_prices_lists', function (Blueprint $table) {
            $table->bigInteger('product_id')->unsigned();
            $table->string('special_price',50)->nullable();
            $table->string('start_date',20)->nullable();
            $table->string('end_date',20)->nullable();
            $table->timestamps();


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
        Schema::dropIfExists('products_specials_prices_lists');
    }
}
