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
        Schema::create('product_ins', function (Blueprint $table) {
            $table->id();
            $table->date("date");
            $table->integer("quantity");
            $table->double("price");
            $table->double("commission");
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('product_buy_id')->constrained('product_buys');
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
        Schema::dropIfExists('product_ins');
    }
};