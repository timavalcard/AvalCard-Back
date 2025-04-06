<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use CMS\User\Models\User;

class CreateServiceMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_meta', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("service_id")->nullable();
            $table->string('key');
            $table->json('value');


            $table->foreign("service_id")
                ->references("id")
                ->on("services")
                ->onDelete('cascade')
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
        Schema::dropIfExists('service_meta');
    }
}
