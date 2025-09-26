<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
     * Get the customer's full name.
     */
    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
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
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($customer) {
            if (empty($customer->customer_id)) {
                $lastCustomer = static::orderBy('id', 'desc')->first();
                $nextNumber = $lastCustomer ? (int) substr($lastCustomer->customer_id, 6) + 1 : 1;
                $customer->customer_id = 'CUST-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
            }
        });
    }
}