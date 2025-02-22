<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders__details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->foreign('orders_id')->references('id')->on('orders')->onDelete('cascade');
            $table->unsignedBigInteger('orders_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->float('price');
            $table->integer('discount');
            $table->float('total_money');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders__details');
    }
};
