<?php

namespace App\Models;

use App\Models\Concerns\GeneratesSeoMeta;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class NewsCategory extends Model
{
    use GeneratesSeoMeta, HasFactory, HasSlug;

    protected $fillable = [
        'name',
        'slug',
        'meta_title',
        'meta_description',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    protected function seoDescriptionSource(): string
    {
        $name = $this->seoTitleSource();

        return $name !== ''
            ? "Browse the latest news and articles in {$name}."
            : '';
    }

    public function news(): HasMany
    {
        return $this->hasMany(News::class);
    }
}
