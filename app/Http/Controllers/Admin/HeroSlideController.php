<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\View\View;

class HeroSlideController extends Controller
{
    public function index(Page $page): View
    {
        return view('admin.hero-slides.index', ['page'=>$page, 'slides'=>$page->heroSlides()->get(), 'positions'=>$this->positions()]);
    }

    public function store(Request $request, Page $page): RedirectResponse
    {
        $data = $this->validated($request, true);
        $data['page_id'] = $page->id;
        $data['image'] = $this->resolveImage($request, null);
        $data['is_active'] = $request->boolean('is_active');
        unset($data['image_url']);
        HeroSlide::query()->create($data);
        return back()->with('success', 'Hero slide added successfully.');
    }

    public function update(Request $request, Page $page, HeroSlide $heroSlide): RedirectResponse
    {
        $this->guardSlide($page, $heroSlide);
        $data = $this->validated($request, false);
        $data['image'] = $this->resolveImage($request, $heroSlide->image);
        $data['is_active'] = $request->boolean('is_active');
        unset($data['image_url']);
        $heroSlide->update($data);
        return back()->with('success', 'Hero slide updated successfully.');
    }

    public function destroy(Page $page, HeroSlide $heroSlide): RedirectResponse
    {
        $this->guardSlide($page, $heroSlide);
        $this->deleteLocalImage($heroSlide->image);
        $heroSlide->delete();
        return back()->with('success', 'Hero slide removed.');
    }

    private function validated(Request $request, bool $creating): array
    {
        return $request->validate([
            'eyebrow'=>['nullable','string','max:120'], 'title'=>['required','string','max:500'],
            'description'=>['nullable','string','max:1000'],
            'image_url'=>[$creating ? 'required_without:image' : 'nullable','nullable','string','max:1200','regex:#^(https?://|/)#i'],
            'image'=>[$creating ? 'required_without:image_url' : 'nullable','nullable','file','mimes:jpg,jpeg,png,webp,avif','max:8192'],
            'image_position'=>['required','in:'.implode(',', array_keys($this->positions()))],
            'primary_label'=>['nullable','string','max:80'], 'primary_url'=>['nullable','string','max:1000','regex:#^(https?://|/|\#)#i'],
            'secondary_label'=>['nullable','string','max:80'], 'secondary_url'=>['nullable','string','max:1000','regex:#^(https?://|/|\#)#i'],
            'sort_order'=>['required','integer','min:0','max:999'], 'is_active'=>['nullable','boolean'],
        ]);
    }

    private function resolveImage(Request $request, ?string $current): string
    {
        if ($request->hasFile('image')) {
            $this->deleteLocalImage($current);
            $directory = public_path('uploads/hero');
            File::ensureDirectoryExists($directory);
            $upload = $request->file('image');
            $filename = Str::uuid().'.'.strtolower($upload->getClientOriginalExtension());
            $upload->move($directory, $filename);
            return '/uploads/hero/'.$filename;
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
        if ($image && str_starts_with($image, '/uploads/hero/')) File::delete(public_path(ltrim($image, '/')));
    }

    private function guardSlide(Page $page, HeroSlide $slide): void
    {
        abort_unless($slide->page_id === $page->id, 404);
    }

    private function positions(): array
    {
        return ['center center'=>'Center','center top'=>'Top','center bottom'=>'Bottom','left center'=>'Left','right center'=>'Right'];
    }
}
