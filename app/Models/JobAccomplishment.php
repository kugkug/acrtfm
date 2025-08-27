<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobAccomplishment extends Model
{
    protected $guarded = ['id'];

    public function area()
    {
        return $this->belongsTo(JobArea::class);
    }

    public function files()
    {
        return $this->hasMany(JobAreaFile::class, 'job_area_id', 'job_area_id');
    }
}