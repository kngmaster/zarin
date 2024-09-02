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
        Schema::create('page_user', function (Blueprint $table) {
            $table->bigInteger('page_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->smallInteger('status')->default(0)->comment('0 deactive,1 active');

            //define foreign
            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            //define foreign
            $table->foreign('page_id')
                ->references('id')
                ->on('pages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_user');
    }
};
