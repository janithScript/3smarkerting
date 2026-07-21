<?php

namespace App\Models\Concerns;

use Illuminate\Support\Str;

trait GeneratesSeoMeta
{
    public static function bootGeneratesSeoMeta(): void
    {
        static::saving(function (self $model): void {
            $model->applyGeneratedSeoMeta();
        });
    }

    protected function applyGeneratedSeoMeta(): void
    {
        $this->meta_title = $this->buildMetaTitle();
        $this->meta_description = $this->buildMetaDescription();
    }

    protected function buildMetaTitle(): string
    {
        $title = $this->seoTitleSource();
        $siteName = (string) config('app.name');

        if ($siteName !== '' && ! Str::contains(Str::lower($title), Str::lower($siteName))) {
            $title = "{$title} | {$siteName}";
        }

        return Str::limit($title, 60, '');
    }

    protected function buildMetaDescription(): string
    {
        $text = $this->seoDescriptionSource();

        if ($text === '') {
            $text = $this->seoTitleSource();
        }

        return Str::limit($text, 160, '...');
    }

    protected function seoTitleSource(): string
    {
        return $this->cleanSeoText((string) ($this->title ?? $this->name ?? ''));
    }

    protected function seoDescriptionSource(): string
    {
        return $this->cleanSeoText((string) ($this->description ?? ''));
    }

    protected function cleanSeoText(string $value): string
    {
        $value = html_entity_decode(strip_tags($value), ENT_QUOTES | ENT_HTML5, 'UTF-8');

        return trim(preg_replace('/\s+/u', ' ', $value) ?? '');
    }
}
