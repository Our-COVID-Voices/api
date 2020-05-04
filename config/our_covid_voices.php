<?php

declare(strict_types=1);

return [

    'repo_url' => 'https://github.com/Our-COVID-Voices/api',

    'frontend_url' => env('FRONTEND_URL'),

    'admin_url' => env('ADMIN_URL'),

    'age_requirement' => [
        'min' => 13,
        'max' => 100,
    ],

    'pagination' => [
        'default' => 10,
        'max' => 100,
    ],

    'file_tokens' => [
        // 5 minutes.
        'expiry_time' => 60 * 5,
    ],

    'admin_email' => 'info@nationalvoices.org.uk',

    'date_format' => 'd/m/Y',

    'datetime_format' => 'd/m/Y H:i:s',

    'otp_enabled' => env('OTP_ENABLED', true),

];
