<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UI extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ui', function (Blueprint $table) {
            $table->id();
            $table->string('social1')->nullable();
            $table->string('social2')->nullable();
            $table->string('social3')->nullable();
            $table->string('social4')->nullable();
            $table->string('cta1_image');
            $table->string('cta1_header', 1024)->nullable();
            $table->string('cta1_desc', 1024)->nullable();
            $table->string('cta1_url', 1024)->nullable();
            $table->string('cta2_image');
            $table->string('cta2_header', 1024)->nullable();
            $table->string('cta2_desc', 1024)->nullable();
            $table->string('cta2_url', 1024)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ui');
    }
}
