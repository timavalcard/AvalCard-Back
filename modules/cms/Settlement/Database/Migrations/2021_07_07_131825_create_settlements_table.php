<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettlementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settlements', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users', 'id')
                ->onDelete('SET NULL');

            $table->string('national_code')->nullable();
            $table->string('cart_number')->nullable();
            $table->float('amount')->unsigned();
            $table->enum('status', \CMS\Settlement\Models\Settlement::$status)->default(\CMS\Settlement\Models\Settlement::STATUS_PENDING);

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
        Schema::dropIfExists('settlements');
    }
}
