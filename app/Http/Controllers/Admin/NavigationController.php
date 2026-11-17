<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NavigationItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NavigationController extends Controller
{
    public function index(): View
    {
        return view('admin.navigation.index', ['items' => NavigationItem::query()->orderBy('sort_order')->orderBy('id')->get()]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate(['items'=>['array'],'items.*.label'=>['required','string','max:80'],'items.*.url'=>['required','string','max:500'],'items.*.location'=>['required','in:main,footer,both'],'items.*.sort_order'=>['required','integer','min:0','max:999'],'items.*.target'=>['required','in:_self,_blank'],'items.*.is_active'=>['required','boolean'],'new_label'=>['nullable','string','max:80'],'new_url'=>['nullable','required_with:new_label','string','max:500'],'new_location'=>['nullable','in:main,footer,both'],'new_sort_order'=>['nullable','integer','min:0','max:999']]);
        foreach ($data['items'] ?? [] as $id => $values) NavigationItem::query()->whereKey($id)->update($values);
        if (! empty($data['new_label'])) {
            NavigationItem::query()->create(['label'=>$data['new_label'],'url'=>$data['new_url'],'location'=>$data['new_location'] ?? 'main','sort_order'=>$data['new_sort_order'] ?? 50,'target'=>'_self','is_active'=>true]);
        }
        return back()->with('success', 'Navigation updated on the public website.');
    }
}
