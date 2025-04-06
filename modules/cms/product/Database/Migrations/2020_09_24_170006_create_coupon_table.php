<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("price_offering");
            $table->enum("price_type",["percent","cash"]);
            $table->bigInteger("number")->nullable();
            $table->string("use_for")->default("all");
            $table->boolean("use_for_first_user")->default(false);
            $table->boolean("add_auto")->default(false);
            $table->boolean("send_free")->default(false);
            $table->string("time");
            $table->string("hour");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupon');
    }
}
