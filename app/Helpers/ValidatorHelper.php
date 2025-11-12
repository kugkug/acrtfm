<?php

declare(strict_types=1);
namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ValidatorHelper {
    const EXCLUDED_FIELDS = [
        'PhoneNumbers', 'Tags'
    ];
    public function validate(string $type, Request $request): array {
        
        $mapped = $this->key_map($request->except([
            ...self::EXCLUDED_FIELDS
        ]));

        
        $validated = Validator::make($mapped, $this->rules($type, $request), [
            'password_confirmation.confirmed' => 'The password did not match.',
            'password.min' => 'The password must be at least 8 characters long.',
            'password_confirmation.min' => 'The password confirmation must be at least 8 characters long.',
        ]);
        
        if ($validated->fails()) {
            return [
                'status' => false,
                'response' => $validated->errors()->first(),
            ];
        }

        return [
            'status' => true,
            'validated' => $validated->validated(),
        ]; 
    }

    private function key_map($to_map): array {

        $mapped = [];
        foreach($to_map as $key => $value) {
            if($value) {
                $mapped[keysHelper()->getKey($key)] = $value;
            }
        }

        return $mapped;
    }

    private function rules(string $type, Request $request) {
        switch($type) {
            case 'company-registration':
                return [
                    'company' => 'required|string|max:255',
                    'address' => 'required|string',
                    'contact' => 'required|string',
                    'email' => 'required|email|unique:users',
                    'contact_person' => 'required|string',
                    'password' => 'required|string|min:8|confirmed',
                    'password_confirmation' => 'required|string|min:8',
                ];
            case 'technician-registration':
                return [
                    'first_name' => 'required|string|max:255',
                    'last_name' => 'required|string|max:255',
                    'email' => 'required|email|unique:users',
                    'phone' => 'required|string|max:12',
                    'company_code' => 'sometimes|string|max:255',
                    'password' => 'required|string|min:8|confirmed',
                    'password_confirmation' => 'required|string|min:8',
                ];
            case 'account-registration':
                return [
                    'first_name' => 'required|string|max:255',
                    'last_name' => 'required|string|max:255',
                    'email' => 'required|email|unique:users',
                    'phone' => 'required|string|max:12',
                    'company' => 'required|string|max:255',
                    'password' => 'required|string|min:8',
                ];
            case 'account-login':
                return [
                    'email' => 'required|email',
                    'password' => 'required|string|min:8',
                ];
            case 'customers-save':
                return [
                    'company' => 'sometimes|string|max:255',
                    'first_name' => 'sometimes|string|max:255',
                    'last_name' => 'sometimes|string|max:255',
                    'email' => 'sometimes|email|unique:customers',
                    'phone' => 'sometimes|string|max:12',
                    'address' => 'sometimes|string|max:255',
                    'notes' => 'sometimes|string|max:255',
                ];
            case 'customers-update':
                return [
                    'company' => 'sometimes|string|max:255',
                    'first_name' => 'sometimes|string|max:255',
                    'last_name' => 'sometimes|string|max:255',
                    'email' => 'sometimes|email|unique:customers,email,' . $request->id,
                    'phone' => 'sometimes|string|max:12',
                    'address' => 'sometimes|string|max:255',
                    'notes' => 'sometimes|string|max:255',
                ];

            case 'customers-save-location':
                return [
                    'customer_id' => 'required|exists:customers,id',
                    'location_name' => 'required|string|max:255',
                    'address' => 'required|string|max:255',
                    'city' => 'required|string|max:255',
                    'state' => 'required|string|max:255',
                    'zip_code' => 'required|string|max:255',
                    'contact_person' => 'required|string|max:255',
                    'contact_email' => 'required|email|max:255',
                    'contact_phone' => 'required|string|max:12',
                    'notes' => 'sometimes|string|max:255',
                ];
            case 'customers-update-location':
                return [
                    'location_name' => 'sometimes|string|max:255',
                    'address' => 'sometimes|string|max:255',
                    'city' => 'sometimes|string|max:255',
                    'state' => 'sometimes|string|max:255',
                    'zip_code' => 'sometimes|string|max:255',
                    'contact_person' => 'sometimes|string|max:255',
                    'contact_email' => 'sometimes|email|max:255',
                    'contact_phone' => 'sometimes|string|max:12',
                    'notes' => 'sometimes|string|max:255',
                ];
            
            case 'customers-save-equipment':
                return [
                    'customer_id' => 'required|exists:customers,id',
                    'customer_location_id' => 'required|exists:customer_locations,id',
                    'equipment_name' => 'required|string|max:255',
                    'equipment_type_id' => 'required|exists:equipment_types,id',
                    'brand' => 'required|string|max:255',
                    'model' => 'required|string|max:255',
                    'serial_number' => 'required|string|max:255',
                    'notes' => 'sometimes|string|max:255',
                ];

            case 'customers-update-equipment':
                return [
                    'customer_location_id' => 'sometimes|exists:customer_locations,id',
                    'equipment_name' => 'sometimes|string|max:255',
                    'equipment_type_id' => 'sometimes|exists:equipment_types,id',
                    'brand' => 'sometimes|string|max:255',
                    'model' => 'sometimes|string|max:255',
                    'serial_number' => 'sometimes|string|max:255',
                    'notes' => 'sometimes|string|max:255',
                ];
            
            case 'work-orders-save':
                return [
                    'customer_id' => 'required|exists:customers,id',
                    'title' => 'required|string|max:255',
                    'priority' => 'required|string|max:10',
                    'estimated_hours' => 'required|numeric',
                    'schedule_date' => 'required',
                    'schedule_time' => 'required',
                    'technician_id' => 'required|exists:users,id',
                    'description' => 'sometimes|string',
                ];
            case 'work-orders-update':
                return [
                    'customer_id' => 'sometimes|exists:customers,id',
                    'title' => 'sometimes|string|max:255',
                    'priority' => 'sometimes|string|max:10',
                    'estimated_hours' => 'sometimes|numeric',
                    'schedule_date' => 'sometimes',
                    'schedule_time' => 'sometimes',
                    'technician_id' => 'sometimes|exists:users,id',
                    'description' => 'sometimes|string',
                ];

            case 'work-orders-add-note':
                return [
                    'note' => 'required|string',
                    'note_type' => 'required|string|in:' . implode(',', array_keys(config('acrtfm.note_types'))),
                ];
        }
    }
}