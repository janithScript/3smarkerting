<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistributorHead extends Model
{
    use HasFactory;

    protected $fillable = [
        'head_name',
        'phone_number',
    ];

    public static function first()
    {
        return static::query()->first() ?? new static();
    }
}
