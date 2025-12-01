<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Builder;

class WorkOrder extends Model {

    protected $guarded = ['id'];
    
    /**
     * The model's default attributes.
     *
     * @var array
     */
    protected $attributes = [
        'status' => 'pending',
    ];
    
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

    public function statement(): HasOne
    {
        return $this->hasOne(WorkOrderStatement::class);
    }

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::addGlobalScope('mine', function (Builder $builder) {
    //         // if (auth()->user()->user_type == config('acrtfm.user_types.company')) {
    //             $builder->where('created_by', auth()->user()->id);
    //     //     } else {
    //     //         $builder->where('technician_id', auth()->user()->id);
    //     //     }
    //     });
    // }
}