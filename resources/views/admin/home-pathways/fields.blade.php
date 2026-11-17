<div class="cms-grid">
    <label><span>Card title</span><input name="title" maxlength="120" value="{{ old('title',$pathway?->title) }}" required placeholder="Child & family support"></label>
    <label><span>Material icon name</span><input name="icon" maxlength="80" value="{{ old('icon',$pathway?->icon ?? 'volunteer_activism') }}" required placeholder="volunteer_activism"><small>Use a name from Google Material Symbols, such as family_restroom, spa or calendar_month.</small></label>
    <label class="cms-full"><span>Description</span><textarea name="description" rows="3" maxlength="300" placeholder="Briefly explain this pathway.">{{ old('description',$pathway?->description) }}</textarea></label>
    <label><span>Destination URL</span><input name="link_url" maxlength="1000" value="{{ old('link_url',$pathway?->link_url) }}" required placeholder="/contact-us or #programs"><small>Use a site path, page section, or full HTTPS URL.</small></label>
    <label><span>Display order</span><input type="number" min="0" max="999" name="sort_order" value="{{ old('sort_order',$pathway?->sort_order ?? (($pathways->max('sort_order') ?? 0)+10)) }}" required></label>
    <label class="switch-field"><input type="hidden" name="is_active" value="0"><input type="checkbox" name="is_active" value="1" @checked(old('is_active',$pathway?->is_active ?? true))><span><strong>Visible on website</strong><small>Turn off to keep this card as a draft.</small></span></label>
</div>
