<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accomplishment extends Model
{
    protected $guarded = ['id'];

    public function details() {
        return $this->hasMany(AccomplishmentDetail::class, 'accomplishment_id', 'id')->with('photos');
    }
}