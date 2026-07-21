<?php

namespace App\Models;

use App\Models\Concerns\GeneratesSeoMeta;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class ProductCategory extends Model
{
    use GeneratesSeoMeta, HasFactory, HasSlug;

    protected $fillable = [
        'name',
        'slug',
        'description',
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
        $description = $this->cleanSeoText((string) ($this->description ?? ''));

        if ($description !== '') {
            return $description;
        }

        $name = $this->seoTitleSource();

        return $name !== ''
            ? "Explore products in the {$name} category."
            : '';
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
