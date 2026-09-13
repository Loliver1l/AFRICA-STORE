<?php
return [
    'paystack' => [
        'secret_key' => env('PAYSTACK_SECRET_KEY'),
        'public_key' => env('PAYSTACK_PUBLIC_KEY'),
    ],
    'binance' => [
        'api_key' => env('BINANCE_PAY_API_KEY'),
        'secret_key' => env('BINANCE_PAY_SECRET_KEY'),
    ],
];
