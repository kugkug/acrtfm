<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerEquipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'customer_location_id',
        'equipment_name',
        'equipment_type',
        'brand',
        'model',
        'serial_number',
        'installation_date',
        'last_service_date',
        'next_service_date',
        'warranty_expiry',
        'specifications',
        'notes',
        'is_active',
    ];

    protected $casts = [
        'installation_date' => 'date',
        'last_service_date' => 'date',
        'next_service_date' => 'date',
        'is_active' => 'boolean',
    ];

    /**
     * Get the customer that owns the equipment.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the location where the equipment is installed.
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(CustomerLocation::class, 'customer_location_id');
    }

    /**
     * Get the equipment type options.
     */
    public static function getEquipmentTypes(): array
    {
        return [
            'HVAC' => 'HVAC System',
            'Generator' => 'Generator',
            'Chiller' => 'Chiller',
            'Boiler' => 'Boiler',
            'Pump' => 'Pump',
            'Compressor' => 'Compressor',
            'Fan' => 'Fan',
            'Motor' => 'Motor',
            'Other' => 'Other',
        ];
    }
}
