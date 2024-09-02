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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('gateway_id')->unsigned();            
            $table->string('bank_transaction_code')->nullable(); 
            $table->string('bank_reference_code')->nullable();                  
            $table->smallInteger('status')->default(1)->comment('0 deactive,1 active');
            $table->timestamps();

             //define foreign
             $table->foreign('user_id')
             ->references('id')
             ->on('users');

                //define foreign
                $table->foreign('gateway_id')
                ->references('id')
                ->on('gatwayes');

               
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
};
