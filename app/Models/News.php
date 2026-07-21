<?php

namespace App\Models;

use App\Models\Concerns\GeneratesSeoMeta;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class News extends Model
{
    use GeneratesSeoMeta, HasFactory, HasSlug;

    protected $fillable = [
        'news_category_id',
        'title',
        'slug',
        'featured_image',
        'description',
        'view_count',
        'like_count',
        'meta_title',
        'meta_description',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
        'view_count' => 'integer',
        'like_count' => 'integer',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(NewsCategory::class, 'news_category_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(NewsComment::class)->whereNull('parent_id');
    }

    public function likes(): HasMany
    {
        return $this->hasMany(NewsLike::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function incrementViewCount()
    {
        $this->increment('view_count');
    }

    public function getCommentCountAttribute()
    {
        return $this->comments()->count();
    }
}
