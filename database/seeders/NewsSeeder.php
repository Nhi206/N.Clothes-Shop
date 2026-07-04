<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        News::create([
            'title' => 'New Print Styles Available',
            'content' => 'We just launched new print styles for our custom products.',
            'image_url' => 'https://example.com/images/news-new-style.jpg',
            'author_id' => 1,
        ]);

        News::create([
            'title' => 'Holiday Bundle Offer',
            'content' => 'Unlock special pricing on print bundles during the holiday season.',
            'image_url' => 'https://example.com/images/news-holiday-bundle.jpg',
            'author_id' => 2,
        ]);
    }
}
