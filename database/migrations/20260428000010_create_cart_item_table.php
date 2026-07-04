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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cart_id');
            $table->unsignedBigInteger('variant_id')->nullable();
            $table->unsignedBigInteger('design_id')->nullable();
            $table->integer('quantity')->default(1);
            $table->unique(['cart_id', 'variant_id', 'design_id']);
            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('variant_id')->references('id')->on('product_variants')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('design_id')->references('id')->on('designs')->onDelete('set null')->onUpdate('cascade');
            $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};