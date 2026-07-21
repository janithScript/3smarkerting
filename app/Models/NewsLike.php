<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NewsLike extends Model
{
    use HasFactory;

    protected $fillable = [
        'news_id',
        'ip_address',
    ];

    public function news(): BelongsTo
    {
        return $this->belongsTo(News::class);
    }
}
