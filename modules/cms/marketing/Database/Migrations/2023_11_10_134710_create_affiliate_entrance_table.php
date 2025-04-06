<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affiliate_entrance', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("affiliate_id")->nullable()->default(0);
            $table->string("link");
            $table->string("user_ip");
            $table->enum("status",["failed","success"])->default("failed");
            $table->timestamps();

            $table->foreign("affiliate_id")
                ->references("id")
                ->on("users")
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
        Schema::dropIfExists('affiliate_entrance');
    }
};
