<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('news_categories', function (Blueprint $table) {
            $table->string('meta_title')->nullable()->after('slug');
            $table->text('meta_description')->nullable()->after('meta_title');
        });

        Schema::table('product_categories', function (Blueprint $table) {
            $table->string('meta_title')->nullable()->after('slug');
            $table->text('meta_description')->nullable()->after('meta_title');
        });

        $siteName = (string) config('app.name');

        foreach (DB::table('news_categories')->orderBy('id')->get() as $category) {
            $title = trim((string) $category->name);
            $metaTitle = $siteName !== '' ? "{$title} | {$siteName}" : $title;

            DB::table('news_categories')->where('id', $category->id)->update([
                'meta_title' => Str::limit($metaTitle, 60, ''),
                'meta_description' => Str::limit(
                    "Browse the latest news and articles in {$title}.",
                    160,
                    '...'
                ),
            ]);
        }

        foreach (DB::table('product_categories')->orderBy('id')->get() as $category) {
            $title = trim((string) $category->name);
            $metaTitle = $siteName !== '' ? "{$title} | {$siteName}" : $title;
            $description = trim(preg_replace(
                '/\s+/u',
                ' ',
                html_entity_decode(strip_tags((string) ($category->description ?? '')), ENT_QUOTES | ENT_HTML5, 'UTF-8')
            ) ?? '');

            if ($description === '') {
                $description = "Explore products in the {$title} category.";
            }

            DB::table('product_categories')->where('id', $category->id)->update([
                'meta_title' => Str::limit($metaTitle, 60, ''),
                'meta_description' => Str::limit($description, 160, '...'),
            ]);
        }
    }

    public function down(): void
    {
        Schema::table('news_categories', function (Blueprint $table) {
            $table->dropColumn(['meta_title', 'meta_description']);
        });

        Schema::table('product_categories', function (Blueprint $table) {
            $table->dropColumn(['meta_title', 'meta_description']);
        });
    }
};
