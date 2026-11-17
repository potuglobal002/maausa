<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model
{
    protected $fillable = [
        'slug', 'title', 'body', 'status', 'published_at',
        'seo_title', 'seo_description', 'author_id',
    ];

    protected function casts(): array
    {
        return [
            'body' => 'array',
            'published_at' => 'datetime',
        ];
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
            ->where(fn ($query) => $query->whereNull('published_at')->orWhere('published_at', '<=', now()));
    }

    public function heroSlides(): HasMany { return $this->hasMany(HeroSlide::class)->orderBy('sort_order')->orderBy('id'); }
    public function homePathways(): HasMany { return $this->hasMany(HomePathway::class)->orderBy('sort_order')->orderBy('id'); }
}
