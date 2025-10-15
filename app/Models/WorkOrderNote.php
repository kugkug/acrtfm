<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkOrderNote extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function work_order()
    {
        return $this->belongsTo(WorkOrder::class);
    }
}