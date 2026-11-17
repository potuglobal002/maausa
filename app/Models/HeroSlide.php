<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HeroSlide extends Model
{
    protected $fillable = ['page_id','eyebrow','title','description','image','image_position','primary_label','primary_url','secondary_label','secondary_url','sort_order','is_active'];
    protected function casts(): array { return ['is_active'=>'boolean','sort_order'=>'integer']; }
    public function page(): BelongsTo { return $this->belongsTo(Page::class); }
}
