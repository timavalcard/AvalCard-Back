<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->unsignedBigInteger('user_id')->nullable()->default(0);
            $table->unsignedBigInteger('media_id')->nullable();

            $table->longText('post_excerpt')->nullable();
            $table->longText('content')->nullable();
            $table->timestamps();


            $table->foreign("user_id")
                ->references("id")
                ->on("users")
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
        Schema::dropIfExists('articles');
    }
}
