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
        Schema::table('products', function (Blueprint $table) {
            $table->index('category_id', 'idx_product_category');
        });

        Schema::table('product_variants', function (Blueprint $table) {
            $table->index('product_id', 'idx_variant_product');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->index('user_id', 'idx_order_user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex('idx_product_category');
        });

        Schema::table('product_variants', function (Blueprint $table) {
            $table->dropIndex('idx_variant_product');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropIndex('idx_order_user');
            $table->timestamps();
    });
    }
};