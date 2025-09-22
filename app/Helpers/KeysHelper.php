<?php

declare(strict_types=1);
namespace App\Helpers;

class KeysHelper {
    const KEYS = [
        'ID' => 'id',
        'FirstName' => 'first_name',
        'LastName' => 'last_name',
        'Email' => 'email',
        'PhoneNumber' => 'phone',
        'Company' => 'company',
        'Password' => 'password',
        
        'CustomerId' => 'customer_id',
        'LocationName' => 'location_name',
        'Address' => 'address',
        'City' => 'city',
        'State' => 'state',
        'ZipCode' => 'zip_code',
        'ContactPerson' => 'contact_person',
        'ContactEmail' => 'contact_email',
        'ContactPhone' => 'contact_phone',
        
        'Company' => 'company',
        'BillingAddress' => 'address',
        'Notes' => 'notes',

        'EquipmentLocation' => 'customer_location_id',
        'EquipmentName' => 'equipment_name',
        'EquipmentTypeId' => 'equipment_type_id',
        'Manufacturer' => 'brand',
        'ModelNumber' => 'model',
        'SerialNumber' => 'serial_number',
        'EquipmentNotes' => 'notes',
    ];

    public function getKey(string $key_index): string {
        return self::KEYS[$key_index];
    }
}