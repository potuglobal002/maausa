<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    private const IMAGES = [
        '/uploads/gallery/maa-family-celebration.jpg',
        '/uploads/gallery/maa-family-community-gathering.jpg',
        '/uploads/gallery/maa-mental-health-matters-event-speaker.jpg',
        '/uploads/gallery/maa-time-tv-10th-anniversary.jpg',
        '/uploads/gallery/maa-mental-health-matters-community-group.jpg',
    ];

    public function up(): void
    {
        $now = now();
        $items = [
            [
                'title' => 'A joyful family celebration',
                'caption' => 'Families sharing a joyful moment together at a community celebration.',
                'image' => self::IMAGES[0],
                'alt_text' => 'A mother and three children smiling together at a community celebration',
                'category' => 'Community',
                'sort_order' => 130,
                'is_featured' => true,
            ],
            [
                'title' => 'Families and friends together',
                'caption' => 'A welcoming gathering that brings families, friends and advocates together.',
                'image' => self::IMAGES[1],
                'alt_text' => 'Families and community members posing together near large windows',
                'category' => 'Community',
                'sort_order' => 140,
                'is_featured' => false,
            ],
            [
                'title' => 'Mental Health Matters',
                'caption' => 'Sharing knowledge and advocacy during Mental Health Awareness Month and Autism Acceptance Month.',
                'image' => self::IMAGES[2],
                'alt_text' => 'A speaker addressing the Mental Health Matters community event',
                'category' => 'Programs',
                'sort_order' => 150,
                'is_featured' => true,
            ],
            [
                'title' => 'Celebrating community media',
                'caption' => 'A community address at Time Television\'s 10th anniversary celebration.',
                'image' => self::IMAGES[3],
                'alt_text' => 'A speaker on stage at Time Television tenth anniversary celebration',
                'category' => 'Community',
                'sort_order' => 160,
                'is_featured' => false,
            ],
            [
                'title' => 'A community that shows up',
                'caption' => 'Community members coming together to support awareness, connection and belonging.',
                'image' => self::IMAGES[4],
                'alt_text' => 'Adults and children gathered together after a community program',
                'category' => 'Programs',
                'sort_order' => 170,
                'is_featured' => false,
            ],
        ];

        foreach ($items as $item) {
            DB::table('gallery_items')->updateOrInsert(
                ['image' => $item['image']],
                $item + [
                    'status' => 'published',
                    'published_at' => $now,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
            );
        }
    }

    public function down(): void
    {
        DB::table('gallery_items')->whereIn('image', self::IMAGES)->delete();
    }
};
