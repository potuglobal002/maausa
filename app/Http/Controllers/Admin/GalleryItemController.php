<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\View\View;

class GalleryItemController extends Controller
{
    public function index(): View
    {
        return view('admin.gallery.index', ['items' => GalleryItem::query()->orderBy('sort_order')->orderByDesc('id')->get()]);
    }

    public function create(): View
    {
        return view('admin.gallery.form', ['item' => new GalleryItem]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request, true);
        $data['image'] = $this->resolveImage($request);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['published_at'] = $data['status'] === 'published' ? ($data['published_at'] ?? now()) : null;
        GalleryItem::query()->create($data);
        return redirect()->route('admin.gallery.index')->with('success', 'Gallery photograph added successfully.');
    }

    public function edit(GalleryItem $galleryItem): View
    {
        return view('admin.gallery.form', ['item' => $galleryItem]);
    }

    public function update(Request $request, GalleryItem $galleryItem): RedirectResponse
    {
        $data = $this->validated($request, false);
        $data['image'] = $this->resolveImage($request, $galleryItem->image);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['published_at'] = $data['status'] === 'published' ? ($data['published_at'] ?? $galleryItem->published_at ?? now()) : null;
        $galleryItem->update($data);
        return redirect()->route('admin.gallery.index')->with('success', 'Gallery photograph updated successfully.');
    }

    public function destroy(GalleryItem $galleryItem): RedirectResponse
    {
        $this->deleteLocalImage($galleryItem->image);
        $galleryItem->delete();
        return back()->with('success', 'Gallery photograph removed.');
    }

    private function validated(Request $request, bool $creating): array
    {
        return $request->validate([
            'title' => ['nullable', 'string', 'max:180'], 'caption' => ['nullable', 'string', 'max:1000'],
            'alt_text' => ['nullable', 'string', 'max:255'], 'category' => ['required', 'string', 'max:80'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:9999'], 'status' => ['required', 'in:draft,published'],
            'published_at' => ['nullable', 'date'], 'image_url' => [$creating ? 'required_without:image' : 'nullable', 'nullable', 'string', 'max:1200', 'regex:#^(https?://|/)#i'],
            'image' => [$creating ? 'required_without:image_url' : 'nullable', 'nullable', 'file', 'mimes:jpg,jpeg,png,webp,avif', 'max:8192'],
        ]);
    }

    private function resolveImage(Request $request, ?string $current = null): string
    {
        if ($request->hasFile('image')) {
            $this->deleteLocalImage($current);
            $directory = public_path('uploads/gallery'); File::ensureDirectoryExists($directory);
            $upload = $request->file('image'); $filename = Str::uuid().'.'.strtolower($upload->getClientOriginalExtension());
            $upload->move($directory, $filename); return '/uploads/gallery/'.$filename;
        }
        if ($request->filled('image_url')) {
            $url = $request->string('image_url')->toString();
            if ($url !== $current) $this->deleteLocalImage($current);
            return $url;
        }
        return (string) $current;
    }

    private function deleteLocalImage(?string $image): void
    {
        if ($image && str_starts_with($image, '/uploads/gallery/')) File::delete(public_path(ltrim($image, '/')));
    }
}
