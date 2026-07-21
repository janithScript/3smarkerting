<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanySetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_email',
        'phone_number',
        'whatsapp_number',
    ];

    public static function first()
    {
        return static::query()->first() ?? new static();
    }
}
