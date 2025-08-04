<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccomplishmentDetail extends Model
{
    protected $guarded = ['id'];

    public function photos() {
        return $this->hasMany(AccomplishmentPhoto::class, 'accomplishment_details_id', 'id');
    }

    public function parent() {
        return $this->belongsTo(Accomplishment::class, 'accomplishment_id', 'id');
    }
}