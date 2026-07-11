<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_user_receives_json_401_when_adding_to_cart_via_ajax(): void
    {
        $product = Product::create([
            'name' => 'Test Product',
            'description' => 'Test description',
        ]);

        $response = $this->withHeader('X-Requested-With', 'XMLHttpRequest')
            ->postJson('/cart/add', [
                'product_id' => $product->id,
                'quantity' => 1,
            ]);

        $response->assertStatus(401)
            ->assertJson([
                'success' => false,
                'message' => 'Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng',
            ]);
    }

    public function test_authenticated_user_can_add_product_to_cart_without_variant_selection(): void
    {
        $user = User::create([
            'name' => 'Cart User',
            'email' => 'cart-user@example.com',
            'password' => bcrypt('password'),
            'role' => 'customer',
            'status' => 'active',
        ]);
        $product = Product::create([
            'name' => 'Variantless Product',
            'description' => 'Test description',
        ]);

        $response = $this->actingAs($user)
            ->postJson('/cart/add', [
                'product_id' => $product->id,
                'variant_id' => '',
                'quantity' => 1,
            ]);

        $response->assertStatus(200)
            ->assertJsonPath('success', true);

        $this->assertDatabaseHas('cart_items', [
            'product_id' => $product->id,
            'variant_id' => null,
            'quantity' => 1,
        ]);
    }
}
