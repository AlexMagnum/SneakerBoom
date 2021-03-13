<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class
Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('manufacturer');
            $table->string('model');
            $table->string('code');
            $table->double('price',15,2);
            $table->double('price_without_discount',15,2)->nullable();
            $table->integer('count');
            $table->string('poster')->nullable();
            $table->string('images', 2048);
            $table->boolean('slider')->nullable()->default(0);
            $table->string('slider_slog')->nullable();
            $table->integer('sale_count')->nullable();
            $table->integer('discount')->nullable();
            $table->string('highlights', 6000)->nullable();
            $table->string('description', 6500)->nullable();
            $table->string('color');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
