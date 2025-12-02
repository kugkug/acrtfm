<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the customer's locations.
     */
    public function locations(): HasMany
    {
        return $this->hasMany(CustomerLocation::class);
    }

    /**
     * Get the customer's equipments.
     */
    public function equipments(): HasMany
    {
        return $this->hasMany(CustomerEquipment::class)->with('equipment_type');
    }

    public function work_orders(): HasMany
    {
        return $this->hasMany(WorkOrder::class);
    }

    /**
     * Get the customer's display name (name or company).
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->name ?: $this->company;
    }

    /**
     * Get the customer's primary location.
     */
    public function primaryLocation()
    {
        return $this->locations()->where('is_primary', true)->first();
    }

    /**
     * Boot method to generate customer_id
     */
    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($customer) {
    //         if (empty($customer->customer_id)) {
    //           $customer->customer_id = date('my') . str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
    //         }
    //     });

    //     static::addGlobalScope('mine', function (Builder $builder) {
    //         if (auth()->user()->user_type == config('acrtfm.user_types.company')) {
    //             $builder->where('created_by', auth()->user()->id);
    //         } else {
    //             $builder->where('technician_id', auth()->user()->id);
    //         }
    //     });
    // }

}