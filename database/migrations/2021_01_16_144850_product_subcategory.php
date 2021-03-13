<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductSubcategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_subcategory', function (Blueprint $table) {
            $table->foreignId('product_id')->references('id')->on('products')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('subcategory_id')->references('id')->on('subcategories')
                ->onUpdate('cascade')
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
        Schema::dropIfExists('product_subcategory');
    }
}
