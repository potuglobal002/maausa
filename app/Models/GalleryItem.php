<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryItem extends Model
{
    protected $fillable = ['title', 'caption', 'image', 'alt_text', 'category', 'sort_order', 'is_featured', 'status', 'published_at'];

    protected function casts(): array
    {
        return ['is_featured' => 'boolean', 'published_at' => 'datetime'];
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')->where(fn ($query) => $query->whereNull('published_at')->orWhere('published_at', '<=', now()));
    }
}
