<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBasketProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basket_product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('basket_id');
            $table->string('product_articul')->unique();
            $table->unsignedTinyInteger('quantity');

            // $table->foreign('basket_id')
            //       ->references('id')
            //       ->on('baskets')
            //       ->cascadeOnDelete();
                  
            // $table->foreign('product_id')
            //       ->references('id')
            //       ->on('products')
            //       ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('basket_product');
    }
}
