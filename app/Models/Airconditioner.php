<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Airconditioner extends Model
{
    use HasFactory;

    public $guarded = [];

    public $hidden =['created_at', 'updated_at'];

    public function manuals(): HasMany {
        return $this->hasMany(Manual::class, 'airconditioner_id');
    }
}