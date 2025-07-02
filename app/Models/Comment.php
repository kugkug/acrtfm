<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];
    
    protected $cast = [
        "created_at" => "datetime:Y-m-d H:00"
    ];

    public function commentor(): HasOne {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}