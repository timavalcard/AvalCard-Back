<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVariationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('priority')->nullable();
            $table->unsignedBigInteger('product_id');
            $table->json('variations');
            $table->integer('price')->nullable();
            $table->integer('offer_price')->nullable();
            $table->integer('weight')->nullable();
            $table->integer('length')->nullable();
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->string('manage_stock', 5)->nullable();
            $table->string('sku')->nullable();
            $table->integer('stock_number')->nullable();
            $table->integer('low_stock_amount')->nullable();
            $table->timestamps();

            $table->foreign("product_id")
                ->references("id")
                ->on("products")
                ->onDelete("CASCADE");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_variation');
    }
}
