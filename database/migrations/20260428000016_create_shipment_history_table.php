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
        Schema::create('shipment_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shipment_id');
            $table->string('status', 50)->nullable();
            $table->timestamp('timestamp')->nullable();
            $table->foreign('shipment_id')->references('id')->on('shipments')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipment_histories');
    }
};