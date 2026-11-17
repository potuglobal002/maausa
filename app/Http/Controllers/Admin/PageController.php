<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PageController extends Controller
{
    public function index(): View
    {
        return view('admin.pages.index', ['pages' => Page::query()->orderBy('title')->get()]);
    }

    public function edit(Page $page): View
    {
        $groups = $this->fieldsFor($page->slug);
        if ($page->slug === 'home') unset($groups['Hero']);

        return view('admin.pages.edit', [
            'page'=>$page,
            'groups'=>$groups,
            'heroSlideCount'=>$page->heroSlides()->count(),
            'homePathwayCount'=>$page->slug === 'home' ? $page->homePathways()->count() : 0,
        ]);
    }

    public function update(Request $request, Page $page): RedirectResponse
    {
        $fields = collect($this->fieldsFor($page->slug))->flatten(1);
        $rules = [
            'title'=>['required','string','max:180'], 'status'=>['required','in:draft,published'],
            'seo_title'=>['nullable','string','max:180'], 'seo_description'=>['nullable','string','max:500'],
            'body'=>['array'],
            'media'=>['nullable','array'], 'media.*'=>['nullable','file','mimes:jpg,jpeg,png,webp,avif','max:8192'],
        ];
        foreach ($fields as $field) {
            $name = $field['name'];
            if (($field['type'] ?? 'text') === 'repeatable') {
                $rules["body.{$name}"] = ['nullable','array','max:'.($field['max'] ?? 20)];
                $rules["body.{$name}.*"] = ['nullable','string','max:30000'];
            } else {
                $rules["body.{$name}"] = ['nullable','string','max:30000'];
            }
        }
        $data = $request->validate($rules);

        $allowed = $fields->pluck('name')->all();
        $mediaFields = $fields->where('type', 'media')->pluck('name')->all();
        $richFields = $fields->where('type', 'richtext')->pluck('name')->all();
        $repeatableFields = $fields->where('type', 'repeatable')->pluck('name')->all();
        $body = array_merge($page->body ?? [], collect($data['body'] ?? [])->only($allowed)->all());

        foreach ($richFields as $field) $body[$field] = $this->sanitizeRichText($body[$field] ?? '');
        foreach ($repeatableFields as $field) {
            $body[$field] = collect($body[$field] ?? [])->map(fn ($paragraph) => trim((string) $paragraph))->filter()->values()->all();
        }
        foreach ($mediaFields as $field) {
            $value = $body[$field] ?? '';
            if ($value !== '' && ! preg_match('#^(https?://|/)#i', $value)) $body[$field] = '';
        }
        foreach ($fields->filter(fn ($field) => str_ends_with($field['name'], '_url'))->pluck('name') as $field) {
            $value = $body[$field] ?? '';
            if ($value !== '' && ! preg_match('#^(https?://|/|\#)#i', $value)) $body[$field] = '#';
        }
        if (! in_array($body['hero_image_position'] ?? 'center center', $this->imagePositions(), true)) $body['hero_image_position'] = 'center center';

        foreach ($request->file('media', []) as $field=>$upload) {
            if (! $upload || ! in_array($field, $mediaFields, true)) continue;
            $old = $body[$field] ?? null;
            if (is_string($old) && str_starts_with($old, '/uploads/pages/')) File::delete(public_path(ltrim($old, '/')));
            $directory = public_path('uploads/pages/'.$page->slug);
            File::ensureDirectoryExists($directory);
            $filename = Str::uuid().'.'.strtolower($upload->getClientOriginalExtension());
            $upload->move($directory, $filename);
            $body[$field] = '/uploads/pages/'.$page->slug.'/'.$filename;
        }

        $page->update([
            'title'=>$data['title'], 'status'=>$data['status'], 'body'=>$body,
            'seo_title'=>$data['seo_title'] ?? null, 'seo_description'=>$data['seo_description'] ?? null,
            'published_at'=>$data['status'] === 'published' ? ($page->published_at ?? now()) : null,
        ]);

        return back()->with('success', 'Page content and media updated successfully.');
    }

    private function fieldsFor(string $slug): array
    {
        $hero = [
            ['name'=>'hero_eyebrow','label'=>'Eyebrow','help'=>'Short context displayed above the main heading.'],
            ['name'=>'hero_title','label'=>'Hero title','type'=>'textarea','rows'=>3,'help'=>'Use a clear, concise headline.'],
            ['name'=>'hero_description','label'=>'Hero description','type'=>'textarea','rows'=>3],
            ['name'=>'hero_image','label'=>'Hero image','type'=>'media','help'=>'Recommended: 1920 × 1080px, landscape, JPG or WebP.'],
            ['name'=>'hero_image_position','label'=>'Image focus','type'=>'select','options'=>$this->positionOptions()],
        ];

        return match ($slug) {
            'home' => [
                'Hero' => [
                    ['name'=>'hero_eyebrow','label'=>'Eyebrow','help'=>'Short context displayed above the main heading.'],
                    ['name'=>'hero_title','label'=>'Hero title','type'=>'textarea','rows'=>3],
                    ['name'=>'hero_lead','label'=>'Introduction','type'=>'textarea','rows'=>3],
                    ['name'=>'hero_image','label'=>'Hero background image','type'=>'media','help'=>'Recommended: 1920 × 1080px, landscape, JPG or WebP.'],
                    ['name'=>'hero_image_position','label'=>'Image focus','type'=>'select','options'=>$this->positionOptions()],
                    ['name'=>'hero_primary_label','label'=>'Primary button label'], ['name'=>'hero_primary_url','label'=>'Primary button URL'],
                    ['name'=>'hero_secondary_label','label'=>'Secondary button label'], ['name'=>'hero_secondary_url','label'=>'Secondary button URL'],
                ],
                'Purpose' => $this->make(['purpose_label'=>'Section label','purpose_title'=>'Title','purpose_text'=>'Text','purpose_image'=>'Feature image','purpose_card_title'=>'Card title','purpose_card_text'=>'Card text'], ['purpose_title','purpose_text','purpose_card_text']),
                'Services' => $this->serviceFields(),
                'Community' => $this->make([
                    'community_label'=>'Section label',
                    'community_title'=>'Section title',
                    'community_image_1'=>'Community image 1',
                    'community_card_1_label'=>'Card 1 category label',
                    'community_card_1_title'=>'Card 1 title',
                    'community_card_1_text'=>'Card 1 description',
                    'community_image_2'=>'Community image 2',
                    'community_card_2_label'=>'Card 2 category label',
                    'community_card_2_title'=>'Card 2 title',
                    'community_card_2_text'=>'Card 2 description',
                ], ['community_title','community_card_1_title','community_card_1_text','community_card_2_title','community_card_2_text']),
                'Call to action' => $this->make(['cta_title'=>'Title','cta_text'=>'Text'], ['cta_title','cta_text']),
            ],
            'who-we-are' => [
                'Hero'=>$hero,
                'Founder'=>[
                    ...$this->make(['founder_image'=>'Founder image','founder_name'=>'Name','founder_credentials'=>'Credentials','founder_role'=>'Professional roles']),
                    ['name'=>'founder_paragraphs','label'=>'Biography paragraphs','type'=>'repeatable','item_label'=>'Paragraph','rows'=>5,'max'=>12,'fallback'=>['founder_intro_1','founder_intro_2','founder_intro_3','founder_intro_4'],'help'=>'Add, remove or reorder paragraphs. Empty paragraphs are not displayed.'],
                ],
                'Impact counters'=>$this->make([
                    'stats_eyebrow'=>'Section label','stats_title'=>'Section title','stats_intro'=>'Section introduction',
                    'stat_1_value'=>'Counter 1 value','stat_1_suffix'=>'Counter 1 suffix','stat_1_label'=>'Counter 1 label',
                    'stat_2_value'=>'Counter 2 value','stat_2_suffix'=>'Counter 2 suffix','stat_2_label'=>'Counter 2 label',
                    'stat_3_value'=>'Counter 3 value','stat_3_suffix'=>'Counter 3 suffix','stat_3_label'=>'Counter 3 label',
                    'stat_4_value'=>'Counter 4 value','stat_4_suffix'=>'Counter 4 suffix','stat_4_label'=>'Counter 4 label',
                ], ['stats_title','stats_intro']),
                'Story & values'=>$this->make(['story_title'=>'Story title','story_1'=>'Story paragraph 1','story_2'=>'Story paragraph 2','story_3'=>'Story paragraph 3','story_4'=>'Story paragraph 4','story_5'=>'Story paragraph 5','quote'=>'Quote','mission'=>'Mission','vision'=>'Vision','nonprofit'=>'501(c)(3) statement'], ['story_1','story_2','story_3','story_4','story_5','quote','mission','vision','nonprofit']),
            ],
            'gallery' => ['Hero'=>$hero],
            'video-gallery' => ['Hero'=>$hero,'Featured videos'=>$this->make(['video_1_title'=>'Video 1 title','video_1_text'=>'Video 1 text','video_1_image'=>'Video 1 cover','video_1_url'=>'Video 1 URL','video_2_title'=>'Video 2 title','video_2_text'=>'Video 2 text','video_2_image'=>'Video 2 cover','video_2_url'=>'Video 2 URL','video_3_title'=>'Video 3 title','video_3_text'=>'Video 3 text','video_3_image'=>'Video 3 cover','video_3_url'=>'Video 3 URL','archive_title'=>'Archive title','archive_text'=>'Archive text'], ['video_1_text','video_2_text','video_3_text','archive_text'])],
            'news-pr' => ['Hero'=>$hero,'Media contact'=>$this->make(['press_title'=>'Press title','press_text'=>'Press text'], ['press_text'])],
            'contact-us' => ['Hero'=>$hero,'Contact form'=>[['name'=>'form_title','label'=>'Form title']]],
            'programs' => ['Hero'=>$hero,'Services'=>$this->serviceFields()],
            default => ['Hero'=>$hero,'Page content'=>[['name'=>'content_title','label'=>'Content title'],['name'=>'content_body','label'=>'Content body','type'=>'richtext','help'=>'Use headings, lists and emphasis to create a readable page.']]],
        };
    }

    private function serviceFields(): array
    {
        $fields = ['programs_label'=>'Section label', 'programs_title'=>'Section title', 'programs_intro'=>'Section introduction'];
        $textareas = ['programs_title', 'programs_intro'];

        foreach (range(1, 8) as $number) {
            $fields["program_{$number}_title"] = "Service {$number} title";
            $fields["program_{$number}_text"] = "Service {$number} description";
            $textareas[] = "program_{$number}_text";
        }

        return $this->make($fields, $textareas);
    }

    private function make(array $fields, array $textareas=[]): array
    {
        return collect($fields)->map(function ($label, $name) use ($textareas) {
            $type = str_contains($name, 'image') ? 'media' : (in_array($name, $textareas, true) ? 'textarea' : 'text');
            return ['name'=>$name,'label'=>$label,'type'=>$type];
        })->values()->all();
    }

    private function sanitizeRichText(string $value): string
    {
        $value = preg_replace('/<(script|style)[^>]*>.*?<\/\1>/is', '', $value) ?? '';
        $value = strip_tags($value, '<p><br><strong><em><ul><ol><li><h2><h3><blockquote>');
        return preg_replace('/<([a-z][a-z0-9]*)\b[^>]*>/i', '<$1>', $value) ?? '';
    }

    private function imagePositions(): array { return array_keys($this->positionOptions()); }
    private function positionOptions(): array { return ['center center'=>'Center','center top'=>'Top','center bottom'=>'Bottom','left center'=>'Left','right center'=>'Right']; }
}
