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
        Schema::create('import_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('import_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity')->nullable(false);
            $table->decimal('price', 10, 2)->nullable(false);
            $table->foreign('import_id')->references('id')->on('import_orders')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('restrict')->onUpdate('cascade');
            $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('import_items');
    }
};