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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('variant_id')->nullable();
            $table->unsignedBigInteger('design_id')->nullable();
            $table->integer('quantity')->nullable(false);
            $table->decimal('price', 10, 2)->nullable(false);
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('variant_id')->references('id')->on('product_variants')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('design_id')->references('id')->on('designs')->onDelete('set null')->onUpdate('cascade');
            $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};