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
            $table->string('title');
            $table->text('description');
            $table->timestamp('end_date');
            $table->smallInteger('is_critical')->default(0)->comment('0->no,1->yes');
            $table->smallInteger('priority')->default(0)->comment('0->low,1->medium,2->high');
            $table->smallInteger('status')->default(0)->comment('0->default,1>In progress,2->done');
            $table->timestamps();

             //define foreign
             $table->foreign('user_id')
             ->references('id')
             ->on('users');
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
