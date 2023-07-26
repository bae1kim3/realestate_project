<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'kakao' =>[
        'client_id' => env('KAKAO_KEY'),
        'client_secret' => env('KAKAO_SECRET'),
        'redirect' => env('KAKAO_REDIRECT_URI')
    ],
    'google' => [
        'client_id' => env('GOOGLE_CLIENT)ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT'),
    ],
    'naver' => [
        'client_id' => env('NAVER_KEY'),
        'client_secret' => env('NAVER_SECRET'),
        'redirect' => env('NAVER_REDIRECT_URI'),
    ],
    'facebook' => [
        'client_id' => '592265133088040',
        'client_secret' => '44a77a5aefeea9d0b817f2e1cfd03630',
        'redirect' => 'http://192.168.0.129/auth/facebook/callback',
    ],

];
