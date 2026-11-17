<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsPost extends Model
{
    protected $fillable = ['slug', 'title', 'category', 'excerpt', 'body', 'featured_image', 'image_alt', 'author', 'is_featured', 'status', 'published_at', 'seo_title', 'seo_description'];

    protected function casts(): array
    {
        return ['is_featured' => 'boolean', 'published_at' => 'datetime'];
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')->where(fn ($query) => $query->whereNull('published_at')->orWhere('published_at', '<=', now()));
    }
}
