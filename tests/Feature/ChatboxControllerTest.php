<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ChatboxControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_chatbox_message_returns_gemini_response(): void
    {
        putenv('GEMINI_API_KEY=test-key');

        Http::fake([
            'https://generativelanguage.googleapis.com/*' => Http::response([
                'candidates' => [
                    [
                        'content' => [
                            'parts' => [
                                ['text' => 'Chào bạn! Tôi có thể giúp gì cho bạn?']
                            ]
                        ]
                    ]
                ]
            ], 200),
        ]);

        $response = $this->postJson('/api/chatbox/message', [
            'message' => 'Xin chào',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'reply' => 'Chào bạn! Tôi có thể giúp gì cho bạn?',
            ]);
    }

    public function test_chatbox_uses_database_for_product_questions(): void
    {
        $category = Category::create(['name' => 'Áo thun']);
        Product::create([
            'name' => 'Áo thun basic',
            'description' => 'Áo thun cotton 100%',
            'price' => 250000,
            'category_id' => $category->id,
            'status' => 'active',
        ]);

        $response = $this->postJson('/api/chatbox/message', [
            'message' => 'Áo thun basic có giá bao nhiêu?',
        ]);

        $response->assertStatus(200);
        $this->assertStringContainsString('Áo thun basic', $response->json('reply'));
    }

    public function test_chatbox_can_suggest_products_for_general_questions(): void
    {
        $category = Category::create(['name' => 'Áo thun']);
        Product::create([
            'name' => 'Áo thun basic',
            'description' => 'Áo thun cotton 100%',
            'price' => 250000,
            'category_id' => $category->id,
            'status' => 'active',
        ]);

        Http::fake([
            'https://generativelanguage.googleapis.com/*' => Http::response([
                'candidates' => [
                    [
                        'content' => [
                            'parts' => [
                                ['text' => 'Mình chưa có câu trả lời.']
                            ]
                        ]
                    ]
                ]
            ], 200),
        ]);

        $response = $this->postJson('/api/chatbox/message', [
            'message' => 'Bạn có những áo nào?',
        ]);

        $response->assertStatus(200);
        $this->assertStringContainsString('Áo thun basic', $response->json('reply'));
    }
}
