<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string("type")->default("product");
            $table->string("name");
            $table->string("slug")->unique();
            $table->integer("offer")->nullable();
            $table->unsignedBigInteger("parent")->default(0)->nullable();
            $table->unsignedBigInteger("media_id")->nullable();
            $table->text("contents")->nullable();
            $table->timestamps();

            $table->foreign("parent")
                  ->references("id")
                  ->on("brands")
                  ->onDelete('set null')
            ;

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
        Schema::dropIfExists('brands');
    }
}
