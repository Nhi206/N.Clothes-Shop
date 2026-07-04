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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('address_id')->nullable();
            $table->unsignedBigInteger('promo_id')->nullable();
            $table->decimal('total_amount', 10, 2)->nullable(false);
            $table->string('status', 50)->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('promo_id')->references('id')->on('promotions')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};