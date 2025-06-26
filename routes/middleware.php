<?php

use App\Http\Middleware\AdminAuthenticate;
use App\Http\Middleware\AdminSession;
use App\Http\Middleware\MemberAuthenticate;

return [
    'web' => [
        \Illuminate\Cookie\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ],

    'api' => [
        \Illuminate\Routing\Middleware\ThrottleRequests::class . ':api',
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ],

    'aliases' => [
        'auth.admin' => AdminAuthenticate::class,
        'auth.member' => MemberAuthenticate::class,
    ],
];
