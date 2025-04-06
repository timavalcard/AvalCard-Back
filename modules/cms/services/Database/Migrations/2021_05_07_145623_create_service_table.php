<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use CMS\User\Models\User;

class CreateServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->unsignedBigInteger("media_id")->nullable();
            $table->unsignedBigInteger("parent")->nullable();

            /*$table->foreign('parent')
                ->references("id")
                ->on("services")
                ->onDelete("CASCADE")
            ;*/


            $table->foreign("media_id")
                ->references("id")
                ->on("media")
                ->onDelete('set null')
            ;

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
        Schema::dropIfExists('services');
    }
}
