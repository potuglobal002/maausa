<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SiteConfigurationSeeder extends Seeder
{
    public function run(): void
    {
        $defaults = [
            'logo_path'=>'/images/maa-logo.png', 'favicon_path'=>'', 'tagline'=>'Mothers for Advocacy & Awareness',
            'copyright_text'=>'MAA — Mothers for Advocacy & Awareness', 'default_language'=>'en', 'timezone'=>'America/New_York',
            'seo_default_title'=>'Mothers for Advocacy & Awareness | MAA',
            'seo_default_description'=>'MAA connects mothers and caregivers with advocacy, resources and a culturally responsive community.',
            'seo_keywords'=>'mothers, advocacy, awareness, neurodivergent families, community support',
            'seo_og_title'=>'Mothers for Advocacy & Awareness',
            'seo_og_description'=>'Stronger mothers. Supported families. Connected communities.',
            'seo_og_image'=>'', 'seo_twitter_handle'=>'', 'seo_canonical_base'=>'', 'seo_indexing'=>true,
            'tracking_enabled'=>false, 'meta_pixel_id'=>'', 'ga4_measurement_id'=>'', 'gtm_container_id'=>'', 'google_site_verification'=>'',
            'social_facebook'=>'', 'social_instagram'=>'', 'social_youtube'=>'', 'social_linkedin'=>'', 'social_x'=>'', 'social_tiktok'=>'', 'social_whatsapp'=>'',
        ];

        foreach ($defaults as $key=>$value) Setting::query()->firstOrCreate(['key'=>$key], ['value'=>$value]);
        Setting::query()->updateOrCreate(['key'=>'logo_path'], ['value'=>'/images/maa-logo.png']);
    }
}
