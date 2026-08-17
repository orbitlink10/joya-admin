<?php

namespace App\Models;

use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'site_name',
        'logo',
        'favicon',
        'phone',
        'email',
        'whatsapp',
        'instagram',
        'location',
        'business_hours',
    ];

    public static function current(): self
    {
        try {
            return static::query()->firstOrCreate([
                'id' => 1,
            ], [
                'site_name' => 'Joya Atelier',
            ]);
        } catch (QueryException) {
            return new static([
                'site_name' => 'Joya Atelier',
            ]);
        }
    }
}
