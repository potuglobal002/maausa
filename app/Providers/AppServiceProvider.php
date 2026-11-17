<?php

namespace App\Providers;

use App\Models\NavigationItem;
use App\Models\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('*', function ($view): void {
            $defaults = [
                'site_name' => 'Mothers for Advocacy & Awareness',
                'logo_text' => 'Maa',
                'logo_path' => '/images/maa-logo.png',
                'favicon_path' => '',
                'tagline' => 'Mothers for Advocacy & Awareness',
                'email' => 'info@maausa.org',
                'phone' => '(347) 394-2979',
                'phone_link' => '+13473942979',
                'address' => "Commonwealth Blvd\nBellerose, NY 11426",
                'footer_description' => 'A nonprofit creating a welcoming space for mothers and families through advocacy, guidance and culturally responsive support.',
                'copyright_text' => 'MAA — Mothers for Advocacy & Awareness',
                'default_language' => 'en',
                'timezone' => 'America/New_York',
                'seo_default_title' => 'Mothers for Advocacy & Awareness | MAA',
                'seo_default_description' => 'MAA connects mothers and caregivers with advocacy, resources and a culturally responsive community.',
                'seo_keywords' => 'mothers, advocacy, awareness, neurodivergent families, community support',
                'seo_og_title' => 'Mothers for Advocacy & Awareness',
                'seo_og_description' => 'Stronger mothers. Supported families. Connected communities.',
                'seo_og_image' => '',
                'seo_twitter_handle' => '',
                'seo_canonical_base' => '',
                'seo_indexing' => true,
                'tracking_enabled' => false,
                'meta_pixel_id' => '', 'ga4_measurement_id' => '', 'gtm_container_id' => '', 'google_site_verification' => '',
                'social_facebook' => '', 'social_instagram' => '', 'social_youtube' => '', 'social_linkedin' => '',
                'social_x' => '', 'social_tiktok' => '', 'social_whatsapp' => '',
            ];

            $settings = $defaults;
            $mainNavigation = collect();
            $footerNavigation = collect();
            $socialLinks = collect();

            if (Schema::hasTable('settings')) {
                $savedSettings = Setting::query()->get()->mapWithKeys(fn (Setting $setting) => [$setting->key => $setting->value])->all();
                $settings = array_merge($defaults, $savedSettings);
            }

            if (Schema::hasTable('navigation_items')) {
                $items = NavigationItem::query()->where('is_active', true)->orderBy('sort_order')->orderBy('id')->get();
                $mainNavigation = $items->whereIn('location', ['main', 'both'])->values();
                $footerNavigation = $items->whereIn('location', ['footer', 'both'])->values();
            }

            $socialLabels = ['social_facebook'=>'Facebook','social_instagram'=>'Instagram','social_youtube'=>'YouTube','social_linkedin'=>'LinkedIn','social_x'=>'X','social_tiktok'=>'TikTok','social_whatsapp'=>'WhatsApp'];
            $socialLinks = collect($socialLabels)->map(fn ($label, $key) => ['label'=>$label,'url'=>$settings[$key] ?? ''])->filter(fn ($item) => filled($item['url']))->values();

            $view->with(compact('settings', 'mainNavigation', 'footerNavigation', 'socialLinks'));
        });
    }
}
