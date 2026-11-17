@extends('layouts.admin')
@section('title', 'Edit '.$page->title.' | MAA Administration')
@section('content')
<div class="admin-shell" x-data="{ navOpen:false }">
    @include('admin.partials.sidebar')
    <main class="admin-main">
        @include('admin.partials.topbar')
        <div class="admin-content page-editor-page">
            <div class="page-editor-heading">
                <div><p class="eyebrow">Content workspace</p><div class="editor-title-row"><h1>{{ $page->title }}</h1><span class="status-pill {{ $page->status }}">{{ ucfirst($page->status) }}</span></div><p>Manage page content, imagery, publishing and search information.</p></div>
                <a class="secondary-action" target="_blank" href="{{ $page->slug === 'home' ? route('home') : url($page->slug) }}">Preview page <span class="material-symbols-outlined">open_in_new</span></a>
            </div>
            @include('admin.partials.flash')

            <form class="cms-form page-editor-form" method="POST" action="{{ route('admin.pages.update',$page) }}" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="page-editor-layout">
                    <aside class="editor-outline">
                        <strong>Page outline</strong>
                        <a href="#publishing"><span class="material-symbols-outlined">tune</span> Publishing & SEO</a>
                        @if($page->slug === 'home')<a href="{{ route('admin.hero-slides.index',$page) }}"><span class="material-symbols-outlined">view_carousel</span> Hero carousel</a><a href="{{ route('admin.home-pathways.index',$page) }}"><span class="material-symbols-outlined">route</span> Support pathways</a>@endif
                        @foreach($groups as $group=>$fields)<a href="#section-{{ Str::slug($group) }}"><span class="outline-number">{{ str_pad($loop->iteration,2,'0',STR_PAD_LEFT) }}</span> {{ $group }}</a>@endforeach
                        <div class="editor-tip"><span class="material-symbols-outlined">lightbulb</span><p>Upload optimized WebP or JPG images for faster page loading.</p></div>
                    </aside>

                    <div class="editor-panels">
                        @if($page->slug === 'home')
                        <section class="cms-card editor-card carousel-manager-card">
                            <div class="carousel-manager-icon"><span class="material-symbols-outlined">view_carousel</span></div>
                            <div><p class="eyebrow">Homepage spotlight</p><h2>Hero carousel</h2><p>Manage slide copy, photography, links, order and visibility in a dedicated workspace.</p></div>
                            <div class="carousel-manager-meta"><strong>{{ $heroSlideCount }}</strong><span>{{ Str::plural('slide',$heroSlideCount) }}</span><a class="module-action" href="{{ route('admin.hero-slides.index',$page) }}">Manage carousel <span class="material-symbols-outlined">arrow_forward</span></a></div>
                        </section>
                        <section class="cms-card editor-card carousel-manager-card">
                            <div class="carousel-manager-icon"><span class="material-symbols-outlined">route</span></div>
                            <div><p class="eyebrow">Homepage navigation</p><h2>Support pathways</h2><p>Manage the cards below the hero, including their copy, icons, links, order and visibility.</p></div>
                            <div class="carousel-manager-meta"><strong>{{ $homePathwayCount }}</strong><span>{{ Str::plural('pathway',$homePathwayCount) }}</span><a class="module-action" href="{{ route('admin.home-pathways.index',$page) }}">Manage pathways <span class="material-symbols-outlined">arrow_forward</span></a></div>
                        </section>
                        @endif
                        @if(in_array($page->slug, ['gallery','news-pr'], true))
                        @php
                            $collectionRoute = $page->slug === 'gallery' ? route('admin.gallery.index') : route('admin.news.index');
                            $collectionTitle = $page->slug === 'gallery' ? 'Image gallery' : 'News & PR articles';
                            $collectionIcon = $page->slug === 'gallery' ? 'photo_library' : 'newspaper';
                        @endphp
                        <section class="cms-card editor-card carousel-manager-card">
                            <div class="carousel-manager-icon"><span class="material-symbols-outlined">{{ $collectionIcon }}</span></div>
                            <div><p class="eyebrow">Dedicated content module</p><h2>{{ $collectionTitle }}</h2><p>Manage individual records, images, publishing status and display order in the dedicated workspace.</p></div>
                            <div class="carousel-manager-meta"><a class="module-action" href="{{ $collectionRoute }}">Manage content <span class="material-symbols-outlined">arrow_forward</span></a></div>
                        </section>
                        @endif
                        <section id="publishing" class="cms-card editor-card">
                            <div class="editor-card-heading"><div><span class="material-symbols-outlined">tune</span><div><h2>Publishing & SEO</h2><p>Control the page identity, visibility and search appearance.</p></div></div></div>
                            <div class="cms-grid">
                                <label><span>Page name</span><input name="title" value="{{ old('title',$page->title) }}" required></label>
                                <label><span>Publication status</span><select name="status"><option value="published" @selected(old('status',$page->status)==='published')>Published</option><option value="draft" @selected(old('status',$page->status)==='draft')>Draft</option></select></label>
                                <label><span>SEO title</span><input name="seo_title" maxlength="180" value="{{ old('seo_title',$page->seo_title) }}"><small>Leave empty to use the global SEO title.</small></label>
                                <label><span>SEO description</span><textarea name="seo_description" rows="3" maxlength="500">{{ old('seo_description',$page->seo_description) }}</textarea><small>Recommended length: 140–160 characters.</small></label>
                            </div>
                        </section>

                        @foreach($groups as $group=>$fields)
                        <section id="section-{{ Str::slug($group) }}" class="cms-card editor-card">
                            <div class="editor-card-heading"><div><span class="section-index">{{ str_pad($loop->iteration,2,'0',STR_PAD_LEFT) }}</span><div><h2>{{ $group }}</h2><p>Update this section’s content and media.</p></div></div><span class="field-count">{{ count($fields) }} fields</span></div>
                            <div class="cms-grid">
                                @foreach($fields as $field)
                                    @php
                                        $type=$field['type'] ?? 'text';
                                        $current=old('body.'.$field['name'],data_get($page->body,$field['name'],''));
                                        if ($type === 'repeatable' && empty($current) && !empty($field['fallback'])) {
                                            $current=collect($field['fallback'])->map(fn($key)=>data_get($page->body,$key))->filter()->values()->all();
                                        }
                                    @endphp
                                    @if($type === 'media')
                                        <div class="cms-full media-field" x-data="mediaPicker(@js($current))">
                                            <div class="field-label"><span>{{ $field['label'] }}</span>@if(isset($field['help']))<small>{{ $field['help'] }}</small>@endif</div>
                                            <div class="media-picker">
                                                <div class="media-preview" :class="{ 'is-empty': !preview && !value }">
                                                    <img x-show="preview || value" :src="preview || value" alt="" onerror="this.style.display='none'">
                                                    <div class="media-empty"><span class="material-symbols-outlined">add_photo_alternate</span><strong>No image selected</strong><small>Upload an image or paste an image URL.</small></div>
                                                </div>
                                                <div class="media-controls">
                                                    <label class="upload-button"><span class="material-symbols-outlined">upload</span> Upload new image<input type="file" name="media[{{ $field['name'] }}]" accept="image/jpeg,image/png,image/webp,image/avif" x-on:change="choose($event)"></label>
                                                    <label><span>Or use an image URL</span><input class="media-url-input" type="text" inputmode="url" autocomplete="off" name="body[{{ $field['name'] }}]" x-model="value" x-on:input="preview=value" placeholder="https://... or /uploads/..."></label>
                                                    <div class="media-control-footer"><button class="remove-media" type="button" x-show="preview || value" x-on:click="clear()">Remove image</button><small>JPG, PNG, WebP or AVIF · Max 8 MB</small></div>
                                                </div>
                                            </div>
                                            @error('media.'.$field['name'])<small class="field-error">{{ $message }}</small>@enderror
                                        </div>
                                    @elseif($type === 'richtext')
                                        <div class="cms-full rich-field" x-data="richEditor(@js($current))">
                                            <div class="field-label"><span>{{ $field['label'] }}</span>@if(isset($field['help']))<small>{{ $field['help'] }}</small>@endif</div>
                                            <div class="rich-editor">
                                                <div class="rich-toolbar" role="toolbar" aria-label="Text formatting">
                                                    <button type="button" x-on:click="format('bold')" title="Bold"><span class="material-symbols-outlined">format_bold</span></button>
                                                    <button type="button" x-on:click="format('italic')" title="Italic"><span class="material-symbols-outlined">format_italic</span></button>
                                                    <button type="button" x-on:click="block('h2')" title="Heading"><span class="material-symbols-outlined">format_h2</span></button>
                                                    <button type="button" x-on:click="format('insertUnorderedList')" title="Bullet list"><span class="material-symbols-outlined">format_list_bulleted</span></button>
                                                    <button type="button" x-on:click="format('insertOrderedList')" title="Numbered list"><span class="material-symbols-outlined">format_list_numbered</span></button>
                                                    <button type="button" x-on:click="block('blockquote')" title="Quote"><span class="material-symbols-outlined">format_quote</span></button>
                                                    <button type="button" x-on:click="format('removeFormat')" title="Clear formatting"><span class="material-symbols-outlined">format_clear</span></button>
                                                </div>
                                                <div class="rich-canvas" contenteditable="true" x-ref="editor" x-on:input="sync()"></div>
                                                <textarea class="sr-only" name="body[{{ $field['name'] }}]" x-model="value"></textarea>
                                            </div>
                                        </div>
                                    @elseif($type === 'repeatable')
                                        <div class="cms-full repeatable-field" x-data="repeatableParagraphs(@js(is_array($current) ? $current : []), {{ $field['max'] ?? 20 }})">
                                            <div class="repeatable-heading">
                                                <div class="field-label"><span>{{ $field['label'] }}</span>@if(isset($field['help']))<small>{{ $field['help'] }}</small>@endif</div>
                                                <button class="repeatable-add" type="button" x-on:click="add()" :disabled="items.length >= limit"><span class="material-symbols-outlined">add</span> Add paragraph</button>
                                            </div>
                                            <div class="repeatable-list">
                                                <template x-for="(item,index) in items" :key="item.id">
                                                    <div class="repeatable-item">
                                                        <div class="repeatable-item-top"><strong>{{ $field['item_label'] ?? 'Item' }} <span x-text="index + 1"></span></strong><div class="repeatable-actions"><button type="button" x-on:click="move(index,-1)" :disabled="index === 0" aria-label="Move paragraph up"><span class="material-symbols-outlined">arrow_upward</span></button><button type="button" x-on:click="move(index,1)" :disabled="index === items.length - 1" aria-label="Move paragraph down"><span class="material-symbols-outlined">arrow_downward</span></button><button class="repeatable-remove" type="button" x-on:click="remove(index)" :disabled="items.length === 1" aria-label="Remove paragraph"><span class="material-symbols-outlined">delete</span></button></div></div>
                                                        <textarea name="body[{{ $field['name'] }}][]" rows="{{ $field['rows'] ?? 4 }}" x-model="item.text" placeholder="Enter biography paragraph"></textarea>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>
                                    @elseif($type === 'select')
                                        <label><span>{{ $field['label'] }}</span><select name="body[{{ $field['name'] }}]">@foreach($field['options'] as $optionValue=>$optionLabel)<option value="{{ $optionValue }}" @selected($current===$optionValue)>{{ $optionLabel }}</option>@endforeach</select>@if(isset($field['help']))<small>{{ $field['help'] }}</small>@endif</label>
                                    @elseif($type === 'textarea')
                                        <label class="cms-full"><span>{{ $field['label'] }}</span><textarea name="body[{{ $field['name'] }}]" rows="{{ $field['rows'] ?? 5 }}">{{ $current }}</textarea>@if(isset($field['help']))<small>{{ $field['help'] }}</small>@endif</label>
                                    @else
                                        <label><span>{{ $field['label'] }}</span><input name="body[{{ $field['name'] }}]" value="{{ $current }}">@if(isset($field['help']))<small>{{ $field['help'] }}</small>@endif</label>
                                    @endif
                                    @error('body.'.$field['name'])<small class="field-error">{{ $message }}</small>@enderror
                                @endforeach
                            </div>
                        </section>
                        @endforeach
                    </div>
                </div>
                <div class="cms-save editor-save"><a href="{{ route('admin.pages.index') }}">← All pages</a><div><span>Last updated {{ $page->updated_at->diffForHumans() }}</span><button class="module-action" type="submit"><span class="material-symbols-outlined">save</span> Save changes</button></div></div>
            </form>
        </div>
    </main>
</div>
@endsection
