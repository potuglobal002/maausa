<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $page = Page::query()->published()->where('slug', 'home')->firstOrFail();
        $content = $page->body ?? [];
        $heroSlides = $page->heroSlides()->where('is_active', true)->get()->map(fn ($slide) => [
            'eyebrow'=>$slide->eyebrow, 'title'=>$slide->title, 'description'=>$slide->description,
            'image'=>$slide->image, 'image_position'=>$slide->image_position,
            'primary_label'=>$slide->primary_label, 'primary_url'=>$slide->primary_url,
            'secondary_label'=>$slide->secondary_label, 'secondary_url'=>$slide->secondary_url,
        ]);
        if ($heroSlides->isEmpty()) $heroSlides = collect([[
            'eyebrow'=>$content['hero_eyebrow'] ?? '', 'title'=>$content['hero_title'] ?? $page->title,
            'description'=>$content['hero_lead'] ?? '', 'image'=>$content['hero_image'] ?? '',
            'image_position'=>$content['hero_image_position'] ?? 'center center',
            'primary_label'=>$content['hero_primary_label'] ?? '', 'primary_url'=>$content['hero_primary_url'] ?? '#purpose',
            'secondary_label'=>$content['hero_secondary_label'] ?? '', 'secondary_url'=>$content['hero_secondary_url'] ?? '#purpose',
        ]]);

        return view('pages.home', [
            'page' => $page,
            'content' => $content,
            'heroSlides' => $heroSlides,
            'pathways' => $page->homePathways()->where('is_active', true)->get(),
            'programs' => collect(range(1, 8))->map(fn (int $number) => [
                'title' => $content["program_{$number}_title"] ?? '',
                'description' => $content["program_{$number}_text"] ?? '',
            ])->filter(fn (array $program) => filled($program['title']))->values(),
        ]);
    }
}
