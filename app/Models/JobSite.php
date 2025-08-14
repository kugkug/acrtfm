<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobSite extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];

    public function areas()
    {
        return $this->hasMany(JobArea::class)->with('files');
    }

}