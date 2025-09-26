<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkOrder extends Model {

    protected $guarded = ['id'];
    
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}