<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::table('navigation_items')->whereIn('url', ['/resources', '/get-support'])->delete();
        DB::table('pages')->whereIn('slug', ['resources', 'get-support'])->delete();

        DB::table('hero_slides')->where('primary_url', '/get-support')->update([
            'primary_label' => 'Contact MAA',
            'primary_url' => '/contact-us',
            'updated_at' => now(),
        ]);
        DB::table('hero_slides')->where('secondary_url', '/resources')->update([
            'secondary_label' => 'Watch videos',
            'secondary_url' => '/video-gallery',
            'updated_at' => now(),
        ]);
        DB::table('hero_slides')->where('secondary_url', '/get-involved')->update([
            'secondary_url' => '/contact-us',
            'updated_at' => now(),
        ]);

        $home = DB::table('pages')->where('slug', 'home')->first();
        if ($home) {
            $body = json_decode($home->body ?? '{}', true) ?: [];
            $body['hero_primary_label'] = 'Contact MAA';
            $body['hero_primary_url'] = '/contact-us';
            unset($body['resources_label'], $body['resources_title']);
            DB::table('pages')->where('id', $home->id)->update(['body' => json_encode($body), 'updated_at' => now()]);
        }
    }

    public function down(): void
    {
        DB::table('pages')->insertOrIgnore([
            ['slug' => 'resources', 'title' => 'Resources', 'body' => json_encode(['hero_eyebrow' => 'Resources', 'hero_title' => 'Clarity for your next step.', 'hero_description' => 'Practical guidance and trusted information for families.']), 'status' => 'draft', 'created_at' => now(), 'updated_at' => now()],
            ['slug' => 'get-support', 'title' => 'Get Support', 'body' => json_encode(['hero_eyebrow' => 'Get support', 'hero_title' => 'You do not have to navigate alone.', 'hero_description' => 'Connect with MAA for guidance.']), 'status' => 'draft', 'created_at' => now(), 'updated_at' => now()],
        ]);
        DB::table('navigation_items')->insertOrIgnore([
            ['label' => 'Resources', 'url' => '/resources', 'location' => 'footer', 'target' => '_self', 'sort_order' => 70, 'is_active' => false, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
};
