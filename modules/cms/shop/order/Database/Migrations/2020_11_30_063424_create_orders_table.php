<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable()->default(0);
            $table->longText('products_id');
            $table->longText('factor')->nullable();
            $table->longText('address')->nullable();
            $table->integer('price');
            $table->string('status');
            $table->string('delivery_status', 100)->nullable();
            $table->string('post_tracking_code', 255)->nullable();
            $table->string('payment_type', 199)->nullable();
            $table->boolean('is_course')->default(false);
            $table->timestamps();

            $table->foreign("user_id")
                ->references("id")
                ->on("users")
                ->onDelete('cascade')
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
        Schema::dropIfExists('shop_setting');
    }
}
