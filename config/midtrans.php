<?php
return [
    'server_key' => env('MIDTRANS_SERVER_KEY', ''),
    'client_key' => env('MIDTRANS_CLIENT_KEY', ''),
    'isProduction' => env('MIDTRANS_IS_PRODUCTION', false),
    'isSandbox' => env('MIDTRANS_IS_SANDBOX', true),
    'isSanitize'=> env('IS_SANITIZE', false),
    'is3ds' => env('MIDTRANS_3DS'),
    'is_debug' => env('MIDTRANS_IS_DEBUG', false),
];
?>