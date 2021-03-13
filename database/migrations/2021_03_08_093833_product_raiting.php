<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductRaiting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_raiting', function (Blueprint $table) {
            $table->id();
            $table->integer('mark');
            $table->foreignId('product_id')->references('id')->on('products')->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('user_id')->references('id')->on('users')->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
