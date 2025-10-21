<?php
    return [
        'manual_url' => env('MANUAL_URL', 'http://manuals.acrtfm.com/'),
        'app_url' => env('APP_URL', 'http://localhost'),
        'companycodematrix' => env('COMPANYCODEMATRIX', 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'),
        'user_types' => [
            'company' => 'Company',
            'technician' => 'Technician',
            'client' => 'client',
            'admin' => 'Admin',
        ],
        
        
        'priority_levels' => [
            'low' => 'Low',
            'medium' => 'Medium',
            'high' => 'High',
            'urgent' => 'Urgent',
        ],

        'note_types' => [
            'general' => [
                'id' => 'general',
                'label' => 'General',
                'badge' => 'badge-info',
            ],
            'accomplishment' => [
                'id' => 'accomplishment',
                'label' => 'Accomplishment',
                'badge' => 'badge-success',
            ],
            'issue' => [
                'id' => 'issue',
                'label' => 'Issue',
                'badge' => 'badge-danger',
            ],
            'material' => [
                'id' => 'material',
                'label' => 'Materials Used',
                'badge' => 'badge-primary',
            ],
        ],
    ];