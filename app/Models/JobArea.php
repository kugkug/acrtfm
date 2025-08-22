<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobArea extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];

    public function files()
    {
        return $this->hasMany(JobAreaFile::class);
    }

    public function site()
    {
        return $this->belongsTo(JobSite::class, 'job_site_id');
    }

    public function accomplishments()
    {
        return $this->hasMany(JobAccomplishment::class);
    }
}