<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('parent_id')->default(0);
            $table->boolean('status')->default(false);
            $table->string('type', 255)->default('comment');
            $table->unsignedBigInteger('comment_able_id');
            $table->string('comment_able_type');
            $table->text('text');
            $table->string('name', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->timestamps();

            $table->foreign("parent_id")
                ->references("id")
                ->on("comments")
                ->onDelete("CASCADE");

            $table->foreign("user_id")
                ->references("id")
                ->on("users")
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
        Schema::dropIfExists('comments');
    }
}
