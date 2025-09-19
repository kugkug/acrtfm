<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerEquipment extends Model
{
    use HasFactory;

    protected $table = 'customer_equipments';
    protected $guarded = ['id'];

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
    public function equipment_type(): BelongsTo
    {
        return $this->belongsTo(EquipmentType::class, 'equipment_type_id');
    }
}