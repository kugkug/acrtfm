<?php

declare(strict_types=1);
namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ValidatorHelper {
    const EXCLUDED_FIELDS = [
        'ConfirmPassword', 'PhoneNumbers', 'Tags'
    ];
    public function validate(string $type, Request $request): array {
        
        $mapped = $this->key_map($request->except([
            ...self::EXCLUDED_FIELDS
        ]));
        
        $validated = Validator::make($mapped, $this->rules($type));
        
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

    private function rules(string $type) {
        switch($type) {
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
                    'company' => 'required|string|max:255',
                    'first_name' => 'required|string|max:255',
                    'last_name' => 'required|string|max:255',
                    'email' => 'required|email|unique:customers',
                    'phone' => 'required|string|max:12',
                    'address' => 'required|string|max:255',
                    'notes' => 'sometimes|string|max:255',
                ];
            case 'customers-update':
                return [
                    'company' => 'required|string|max:255',
                    'first_name' => 'required|string|max:255',
                    'last_name' => 'required|string|max:255',
                    'email' => 'required|email|unique:customers',
                    'phone' => 'required|string|max:12',
                    'address' => 'required|string|max:255',
                    'notes' => 'sometimes|string|max:255',
                ];
        }
    }
}