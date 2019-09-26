<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TransactionDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_detail', function(Blueprint $table){
          $table->bigIncrements('id');
          $table->bigInteger('transaction_id');
          $table->bigInteger('item_id');
          $table->bigInteger('batch_id');
          $table->timestamp('created_at')->useCurrent()->nullable();
          $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExist('transaction_detail');
    }
}
