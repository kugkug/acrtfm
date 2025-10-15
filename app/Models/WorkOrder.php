<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class WorkOrder extends Model {

    protected $guarded = ['id'];
    
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function photos(): HasMany
    {
        return $this->hasMany(WorkOrderPhoto::class);
    }

    public function notes(): HasMany
    {
        return $this->hasMany(WorkOrderNote::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('mine', function (Builder $builder) {
            $builder->where('created_by', auth()->user()->id);
        });

    }
}