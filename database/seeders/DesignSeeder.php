<?php

namespace Database\Seeders;

use App\Models\Design;
use Illuminate\Database\Seeder;

class DesignSeeder extends Seeder
{
    public function run(): void
    {
        Design::create([
            'user_id' => 3,
            'product_id' => 1,
            'design_data' => '{"layers":[{"type":"text","value":"Hello World"}],"settings":{"color":"black"}}',
            'preview_image' => 'https://example.com/images/design-preview-1.png',
            'expired_at' => now()->addDays(30),
        ]);

        Design::create([
            'user_id' => 4,
            'product_id' => 2,
            'design_data' => '{"layers":[{"type":"image","src":"logo.png"}],"settings":{"background":"grey"}}',
            'preview_image' => 'https://example.com/images/design-preview-2.png',
            'expired_at' => now()->addDays(60),
        ]);

        Design::create([
            'user_id' => 5,
            'product_id' => 3,
            'design_data' => '{"layers":[{"type":"text","value":"Live Bold"}],"settings":{"font":"sans-serif"}}',
            'preview_image' => 'https://example.com/images/design-preview-3.png',
            'expired_at' => now()->addDays(45),
        ]);
    }
}
