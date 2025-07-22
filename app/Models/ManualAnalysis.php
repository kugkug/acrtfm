<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManualAnalysis extends Model
{
    use HasFactory;

    protected $fillable = [
        'filename',
        'file_path',
        'summary',
        'keywords',
        'metadata',
        'full_text',
        'model_number',
        'brand',
        'type',
        'file_size',
        'analyzed_at',
    ];

    protected $casts = [
        'keywords' => 'array',
        'metadata' => 'array',
        'analyzed_at' => 'datetime',
    ];

    /**
     * Search manuals by query
     */
    public static function searchByQuery($query)
    {
        return self::where(function ($q) use ($query) {
            $q->where('summary', 'like', "%{$query}%")
              ->orWhere('full_text', 'like', "%{$query}%")
              ->orWhere('model_number', 'like', "%{$query}%")
              ->orWhere('brand', 'like', "%{$query}%")
              ->orWhere('type', 'like', "%{$query}%")
              ->orWhereJsonContains('keywords', $query);
        })->orderBy('analyzed_at', 'desc');
    }

    /**
     * Get manuals by brand
     */
    public static function getByBrand($brand)
    {
        return self::where('brand', 'like', "%{$brand}%");
    }

    /**
     * Get manuals by type
     */
    public static function getByType($type)
    {
        return self::where('type', 'like', "%{$type}%");
    }
}