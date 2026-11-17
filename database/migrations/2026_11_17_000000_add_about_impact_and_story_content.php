<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        $page = DB::table('pages')->where('slug', 'who-we-are')->first();
        if (! $page) return;

        $body = array_merge(json_decode($page->body ?? '{}', true) ?: [], [
            'stats_eyebrow' => 'Our impact',
            'stats_title' => 'A growing village of support.',
            'stats_intro' => 'Every number represents a family reached, a conversation started and a stronger community built together.',
            'stat_1_value' => '2', 'stat_1_suffix' => '+', 'stat_1_label' => 'Years in Charity',
            'stat_2_value' => '20', 'stat_2_suffix' => '+', 'stat_2_label' => 'Staff Members',
            'stat_3_value' => '2', 'stat_3_suffix' => '+', 'stat_3_label' => 'Countries',
            'stat_4_value' => '200', 'stat_4_suffix' => '+', 'stat_4_label' => 'People Helped',
            'story_title' => 'Every mother deserves to be heard.',
            'story_1' => 'Across the world, mothers are connected by a common priority: the well-being of their children. Mothers are often their children’s strongest advocates and, at times, their only voice.',
            'story_2' => 'Mothers for Advocacy & Awareness (MAA) is a nonprofit organization that supports mothers and caregivers with practical resources throughout motherhood. Alongside caring for children’s mental and physical health, MAA recognizes that caregivers also need support for their own mental well-being.',
            'story_3' => 'MAA provides a welcoming, judgment-free community where mothers can share opinions, struggles, frustrations and achievements. Through honest conversation and connection, mothers can encourage and inspire others travelling a similar path.',
            'story_4' => 'Families of neurodivergent children can feel overwhelmed while navigating diagnosis, education and therapy. Cultural and language barriers may make it harder to understand available services, seek appropriate guidance and advocate confidently for a child’s rights.',
            'story_5' => 'MAA helps mothers and caregivers navigate systems, understand Individualized Education Programs and identify appropriate services. With particular attention to South Asian families, MAA works to reduce cultural and language barriers so families feel informed, connected and supported at every step.',
            'quote' => 'It takes a village to raise a child. Let’s build the village.',
            'mission' => 'To support mothers and caregivers with culturally responsive resources, practical guidance and advocacy throughout motherhood, helping families understand services and make informed decisions.',
            'vision' => 'A welcoming, judgment-free community where mothers can share struggles, achievements and ideas, and where neurodivergent individuals and their families feel understood, connected and empowered.',
            'nonprofit' => 'MAA is a federally recognized 501(c)(3) tax-exempt nonprofit organization. Contributions are tax-deductible to the fullest extent permitted by law.',
        ]);

        DB::table('pages')->where('id', $page->id)->update([
            'body' => json_encode($body, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        // Content migrations are intentionally non-destructive.
    }
};
