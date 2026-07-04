<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            AddressSeeder::class,
            CategorySeeder::class,
            BrandSeeder::class,
            ProductSeeder::class,
            ProductVariantSeeder::class,
            ProductImageSeeder::class,
            DesignSeeder::class,
            CartSeeder::class,
            CartItemSeeder::class,
            PromotionSeeder::class,
            OrderSeeder::class,
            OrderItemSeeder::class,
            PaymentSeeder::class,
            ShipmentSeeder::class,
            ShipmentHistorySeeder::class,
            ReviewSeeder::class,
            WishlistSeeder::class,
            SupportTicketSeeder::class,
            BannerSeeder::class,
            NewsSeeder::class,
            SupplierSeeder::class,
            ImportOrderSeeder::class,
            ImportItemSeeder::class,
        ]);
    }
}
