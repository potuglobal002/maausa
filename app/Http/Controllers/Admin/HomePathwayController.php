<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomePathway;
use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomePathwayController extends Controller
{
    public function index(Page $page): View
    {
        abort_unless($page->slug === 'home', 404);

        return view('admin.home-pathways.index', [
            'page' => $page,
            'pathways' => $page->homePathways()->get(),
        ]);
    }

    public function store(Request $request, Page $page): RedirectResponse
    {
        abort_unless($page->slug === 'home', 404);
        $data = $this->validated($request);
        $data['page_id'] = $page->id;
        $data['is_active'] = $request->boolean('is_active');
        HomePathway::query()->create($data);

        return back()->with('success', 'Homepage pathway added successfully.');
    }

    public function update(Request $request, Page $page, HomePathway $homePathway): RedirectResponse
    {
        $this->guardPathway($page, $homePathway);
        $data = $this->validated($request);
        $data['is_active'] = $request->boolean('is_active');
        $homePathway->update($data);

        return back()->with('success', 'Homepage pathway updated successfully.');
    }

    public function destroy(Page $page, HomePathway $homePathway): RedirectResponse
    {
        $this->guardPathway($page, $homePathway);
        $homePathway->delete();

        return back()->with('success', 'Homepage pathway removed.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:120'],
            'description' => ['nullable', 'string', 'max:300'],
            'icon' => ['required', 'string', 'max:80', 'regex:/^[a-z0-9_]+$/'],
            'link_url' => ['required', 'string', 'max:1000', 'regex:#^(https?://|/|\#)#i'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:999'],
            'is_active' => ['nullable', 'boolean'],
        ]);
    }

    private function guardPathway(Page $page, HomePathway $pathway): void
    {
        abort_unless($page->slug === 'home' && $pathway->page_id === $page->id, 404);
    }
}
