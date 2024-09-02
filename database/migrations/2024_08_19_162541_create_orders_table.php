<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('transaction_id')->unsigned()->nullable();
            $table->integer('quantity')->nullable()->default(0);        
            $table->smallInteger('status')->default(1)->comment('0 deactive,1 active');
            $table->timestamps();

             //define foreign
             $table->foreign('user_id')
             ->references('id')
             ->on('users');

                //define foreign
                $table->foreign('transaction_id')
                ->references('id')
                ->on('transactions');

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
