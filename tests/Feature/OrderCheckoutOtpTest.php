<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderCheckoutOtpTest extends TestCase
{
    use RefreshDatabase;

    public function test_online_payment_requires_valid_otp_code(): void
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'phone' => '0901234567',
            'role' => 'customer',
            'status' => 'active',
        ]);
        $product = Product::create([
            'name' => 'Test Product',
            'description' => 'Test description',
            'price' => 100000,
            'is_customizable' => false,
            'category_id' => null,
            'brand_id' => null,
            'status' => 'active',
        ]);
        $cart = Cart::create(['user_id' => $user->id]);
        CartItem::create([
            'cart_id' => $cart->id,
            'product_id' => $product->id,
            'quantity' => 1,
        ]);

        $this->actingAs($user);
        $this->withSession(['payment_otp' => '123456']);

        $response = $this->post(route('orders.store'), [
            'address_detail' => '123 Đường Test, Quận 1, TP.HCM',
            'phone' => '0901234567',
            'payment_method' => 'card',
            'card_number' => '4111111111111111',
            'card_holder' => 'Nguyen Van A',
            'expiry_month' => '12',
            'expiry_year' => '30',
            'cvv' => '123',
            'selected_items' => [$cart->items()->first()->id],
            'otp_code' => '000000',
        ]);

        $response->assertSessionHasErrors('otp_code');
    }
}
