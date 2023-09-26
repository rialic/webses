<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie', 'login', 'logout', 'register', 'states', 'cities'],

    'allowed_methods' => ['GET', 'HEAD', 'POST', 'PUT', 'DELETE', 'OPTIONS'],

    'allowed_origins' => explode(',', env('FRONTEND_URL', 'https://localhost:3000')),

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['Accept', 'Authorization', 'Cache-Control', 'Content-Type', 'Origin', 'User-Agent', 'X-Requested-With', 'Subdomain', 'X-XSRF-TOKEN', 'withCredentials'],

    'exposed_headers' => [],

    'max_age' => 86400,

    'supports_credentials' => true,

];
