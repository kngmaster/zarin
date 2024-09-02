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
        Schema::create('gatewayes', function (Blueprint $table) {
            $table->id();          
            $table->string('name')->nullable(); 
            $table->string('url')->nullable(); 
            $table->string('callback_url')->nullable(); 
            $table->string('startpay_url')->nullable(); 
            $table->string('api_key')->nullable(); 
            $table->string('password')->nullable(); 
            $table->smallInteger('status')->default(1)->comment('0 deactive,1 active');
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
        Schema::dropIfExists('gatewayes');
    }
};
