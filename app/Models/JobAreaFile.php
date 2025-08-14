<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobAreaFile extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];

    public function area()
    {
        return $this->belongsTo(JobArea::class);
    }
}