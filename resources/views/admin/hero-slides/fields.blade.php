@php($currentImage = old('image_url', $slide?->image ?? ''))
<div class="slide-fields">
    <div class="slide-image-editor">
        <div class="slide-image-preview" style="background-image:url('{{ $currentImage }}');background-position:{{ old('image_position',$slide?->image_position ?? 'center center') }}"></div>
        <div><label class="upload-button"><span class="material-symbols-outlined">upload</span> Choose image<input type="file" name="image" accept="image/jpeg,image/png,image/webp,image/avif"></label><label><span>Or use an image URL</span><input class="media-url-input" type="text" inputmode="url" autocomplete="off" name="image_url" value="{{ $currentImage }}" placeholder="https://... or /uploads/..."></label><small>Landscape JPG, PNG, WebP or AVIF · Maximum 8 MB</small></div>
    </div>
    <div class="cms-grid">
        <label><span>Eyebrow</span><input name="eyebrow" value="{{ old('eyebrow',$slide?->eyebrow) }}" placeholder="Mothers for Advocacy & Awareness"></label>
        <label><span>Image focus</span><select name="image_position">@foreach($positions as $value=>$label)<option value="{{ $value }}" @selected(old('image_position',$slide?->image_position ?? 'center center')===$value)>{{ $label }}</option>@endforeach</select></label>
        <label class="cms-full"><span>Headline</span><textarea name="title" rows="4" required placeholder="Use a new line for each phrase">{{ old('title',$slide?->title) }}</textarea><small>Short lines create the strongest rhythm on desktop and mobile.</small></label>
        <label class="cms-full"><span>Description</span><textarea name="description" rows="3">{{ old('description',$slide?->description) }}</textarea></label>
        <label><span>Primary button label</span><input name="primary_label" value="{{ old('primary_label',$slide?->primary_label) }}"></label>
        <label><span>Primary button URL</span><input name="primary_url" value="{{ old('primary_url',$slide?->primary_url) }}" placeholder="/contact-us"></label>
        <label><span>Secondary button label</span><input name="secondary_label" value="{{ old('secondary_label',$slide?->secondary_label) }}"></label>
        <label><span>Secondary button URL</span><input name="secondary_url" value="{{ old('secondary_url',$slide?->secondary_url) }}" placeholder="/who-we-are"></label>
        <label><span>Display order</span><input type="number" min="0" max="999" name="sort_order" value="{{ old('sort_order',$slide?->sort_order ?? (($slides->max('sort_order') ?? 0)+10)) }}" required></label>
        <label class="switch-field"><input type="hidden" name="is_active" value="0"><input type="checkbox" name="is_active" value="1" @checked(old('is_active',$slide?->is_active ?? true))><span><strong>Visible on website</strong><small>Turn off to keep this slide as a draft.</small></span></label>
    </div>
</div>
