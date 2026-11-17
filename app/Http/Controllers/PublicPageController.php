<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\GalleryItem;
use App\Models\NewsPost;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PublicPageController extends Controller
{
    public function about(): View
    {
        return view('pages.about', $this->pageData('who-we-are'));
    }

    public function gallery(): View
    {
        $data = $this->pageData('gallery');
        $data['images'] = GalleryItem::query()->published()->orderByDesc('is_featured')->orderBy('sort_order')->orderByDesc('published_at')->get();
        $data['categories'] = $data['images']->pluck('category')->filter()->unique()->values();

        return view('pages.gallery', $data);
    }

    public function videos(): View
    {
        $data = $this->pageData('video-gallery');
        $data['collections'] = collect(range(1, 3))->map(fn (int $number) => [
            'title' => $data['content']["video_{$number}_title"] ?? '',
            'description' => $data['content']["video_{$number}_text"] ?? '',
            'image' => $data['content']["video_{$number}_image"] ?? '',
            'url' => $data['content']["video_{$number}_url"] ?? 'https://maausa.org/video-gallery/',
        ]);

        return view('pages.videos', $data);
    }

    public function news(): View
    {
        $data = $this->pageData('news-pr');
        $posts = NewsPost::query()->published()->latest('published_at')->latest('id')->get();
        $data['featuredPost'] = $posts->firstWhere('is_featured', true) ?? $posts->first();
        $data['posts'] = $posts->when($data['featuredPost'], fn ($items) => $items->where('id', '!=', $data['featuredPost']->id))->values();
        $data['categories'] = $posts->pluck('category')->filter()->unique()->values();
        return view('pages.news', $data);
    }

    public function newsShow(NewsPost $newsPost): View
    {
        abort_unless($newsPost->status === 'published' && (! $newsPost->published_at || $newsPost->published_at->isPast()), 404);
        $data = $this->pageData('news-pr');
        $data['post'] = $newsPost;
        $data['relatedPosts'] = NewsPost::query()->published()->whereKeyNot($newsPost->id)->where('category', $newsPost->category)->latest('published_at')->limit(3)->get();
        return view('pages.news-show', $data);
    }

    public function contact(): View
    {
        return view('pages.contact', $this->pageData('contact-us'));
    }

    public function programs(): View
    {
        $data = $this->pageData('programs');
        $data['programs'] = collect(range(1, 8))->map(fn (int $number) => [
            'title' => $data['content']["program_{$number}_title"] ?? '',
            'description' => $data['content']["program_{$number}_text"] ?? '',
        ])->filter(fn (array $program) => filled($program['title']))->values();

        return view('pages.programs', $data);
    }

    public function generic(string $slug): View
    {
        return view('pages.generic', $this->pageData($slug));
    }

    public function submitContact(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:40'],
            'subject' => ['required', 'string', 'max:160'],
            'message' => ['required', 'string', 'max:5000'],
            'consent' => ['accepted'],
        ]);

        DB::table('inquiries')->insert([
            'type' => 'contact',
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'message' => $data['subject']."\n\n".$data['message'],
            'status' => 'new',
            'consent_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Thank you. Your message has been received by MAA.');
    }

    private function pageData(string $slug): array
    {
        $page = Page::query()->published()->where('slug', $slug)->firstOrFail();

        return ['page' => $page, 'content' => $page->body ?? []];
    }
}
