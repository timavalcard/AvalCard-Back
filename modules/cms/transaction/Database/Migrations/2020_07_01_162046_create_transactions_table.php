<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use CMS\Transaction\Models\Transaction;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
             $table->id();
             $table->integer("user_id");
             $table->string("transaction_id");
             $table->enum("status",Transaction::$statuses)->default(Transaction::$PENDING);
             $table->integer("price");
             $table->string("gateway")->nullable();
             $table->unsignedBigInteger("transactionable_id");
             $table->string("transactionable_type");
             $table->text("error_text")->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
