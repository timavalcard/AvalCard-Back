<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->id();
            $table->string("type")->default("article");
            $table->string("name");
            $table->string("slug")->unique();
            $table->integer("offer")->nullable();
            $table->unsignedBigInteger("parent")->default(0)->nullable();
            $table->unsignedBigInteger("media_id")->nullable();
            $table->longtext("contents")->nullable();
            $table->timestamps();

            $table->foreign("parent")
                  ->references("id")
                  ->on("category")
                  ->onDelete('cascade')
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
        Schema::dropIfExists('category');
    }
}
