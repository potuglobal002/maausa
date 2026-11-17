<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsPost;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class NewsPostController extends Controller
{
    public function index(): View
    {
        return view('admin.news.index', ['posts' => NewsPost::query()->latest('published_at')->latest('id')->get()]);
    }

    public function create(): View
    {
        return view('admin.news.form', ['post' => new NewsPost]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['slug'] = $this->uniqueSlug($data['slug'] ?: $data['title']);
        $data['featured_image'] = $this->resolveImage($request);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['body'] = $this->sanitizeRichText($data['body'] ?? '');
        $data['published_at'] = $data['status'] === 'published' ? ($data['published_at'] ?? now()) : null;
        NewsPost::query()->create($data);
        return redirect()->route('admin.news.index')->with('success', 'News article created successfully.');
    }

    public function edit(NewsPost $newsPost): View
    {
        return view('admin.news.form', ['post' => $newsPost]);
    }

    public function update(Request $request, NewsPost $newsPost): RedirectResponse
    {
        $data = $this->validated($request, $newsPost);
        $baseSlug = Str::slug($data['slug'] ?: $data['title']);
        $data['slug'] = $this->uniqueSlug($baseSlug, $newsPost->id);
        $data['featured_image'] = $this->resolveImage($request, $newsPost->featured_image);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['body'] = $this->sanitizeRichText($data['body'] ?? '');
        $data['published_at'] = $data['status'] === 'published' ? ($data['published_at'] ?? $newsPost->published_at ?? now()) : null;
        $newsPost->update($data);
        return redirect()->route('admin.news.index')->with('success', 'News article updated successfully.');
    }

    public function destroy(NewsPost $newsPost): RedirectResponse
    {
        $this->deleteLocalImage($newsPost->featured_image); $newsPost->delete();
        return back()->with('success', 'News article removed.');
    }

    private function validated(Request $request, ?NewsPost $post = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:220'],
            'slug' => ['nullable', 'string', 'max:220', Rule::unique('news_posts', 'slug')->ignore($post?->id)],
            'category' => ['required', 'string', 'max:80'], 'excerpt' => ['nullable', 'string', 'max:600'],
            'body' => ['nullable', 'string', 'max:100000'], 'image_alt' => ['nullable', 'string', 'max:255'],
            'author' => ['nullable', 'string', 'max:120'], 'status' => ['required', 'in:draft,published'],
            'published_at' => ['nullable', 'date'], 'seo_title' => ['nullable', 'string', 'max:180'],
            'seo_description' => ['nullable', 'string', 'max:500'],
            'image_url' => ['nullable', 'string', 'max:1200', 'regex:#^(https?://|/)#i'],
            'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,avif', 'max:8192'],
        ]);
    }

    private function uniqueSlug(string $value, ?int $ignore = null): string
    {
        $base = Str::slug($value) ?: 'maa-news'; $slug = $base; $number = 2;
        while (NewsPost::query()->where('slug', $slug)->when($ignore, fn ($query) => $query->whereKeyNot($ignore))->exists()) $slug = $base.'-'.$number++;
        return $slug;
    }

    private function resolveImage(Request $request, ?string $current = null): ?string
    {
        if ($request->hasFile('image')) {
            $this->deleteLocalImage($current); $directory = public_path('uploads/news'); File::ensureDirectoryExists($directory);
            $upload = $request->file('image'); $filename = Str::uuid().'.'.strtolower($upload->getClientOriginalExtension());
            $upload->move($directory, $filename); return '/uploads/news/'.$filename;
        }
        if ($request->filled('image_url')) {
            $url = $request->string('image_url')->toString(); if ($url !== $current) $this->deleteLocalImage($current); return $url;
        }
        return $current;
    }

    private function deleteLocalImage(?string $image): void
    {
        if ($image && str_starts_with($image, '/uploads/news/')) File::delete(public_path(ltrim($image, '/')));
    }

    private function sanitizeRichText(string $value): string
    {
        $value = preg_replace('/<(script|style)[^>]*>.*?<\/\1>/is', '', $value) ?? '';
        return strip_tags($value, '<p><br><strong><em><ul><ol><li><h2><h3><blockquote><a>');
    }
}
