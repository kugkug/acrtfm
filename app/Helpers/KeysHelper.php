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
        
        'Company' => 'company',
        'BillingAddress' => 'address',
        'Notes' => 'notes',
    ];

    public function getKey(string $key_index): string {
        return self::KEYS[$key_index];
    }
}