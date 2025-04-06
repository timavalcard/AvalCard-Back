<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('media_id')->nullable();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->text('post_excerpt')->nullable();
            $table->longText('content')->nullable();
            $table->string('product_type', 100)->default('product');
            $table->string('status', 100)->nullable()->default('publish');
            $table->timestamps();

            $table->foreign("media_id")
                ->references("id")
                ->on("media")
                ->onDelete('set null')
            ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
