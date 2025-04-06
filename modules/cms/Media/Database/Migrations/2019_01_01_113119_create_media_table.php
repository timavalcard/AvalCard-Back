<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('media', function (Blueprint $table) {
            $supported_extension=[];
            foreach (config('mediaFile.MediaTypeServices') as $type => $service) {
                foreach ($service["extensions"] as $extension){
                    $supported_extension[]=$extension;

                }

            }
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->json('files');
            $table->enum('type', $supported_extension);
            $table->string('filename', 255);
            $table->boolean('is_private');
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
        Schema::dropIfExists('media');
    }
}
