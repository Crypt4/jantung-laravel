<?php

use Crypt4\JantungLaravel\Handler\HandleCommandEvent;
use Crypt4\JantungLaravel\Handler\HandleExceptionEvent;
use Crypt4\JantungLaravel\Handler\HandleFailedJobEvent;
use Crypt4\JantungLaravel\Handler\HandleHttpRequestEvent;
use Crypt4\JantungLaravel\Handler\HandleNotificationFailedEvent;
use Crypt4\JantungLaravel\Handler\HandleQueryExecutedEvent;
use Illuminate\Console\Events\CommandFinished;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Foundation\Http\Events\RequestHandled;
use Illuminate\Log\Events\MessageLogged;
use Illuminate\Notifications\Events\NotificationFailed;
use Illuminate\Queue\Events\JobFailed;

return [
    'enabled' => env('JANTUNG_ENABLED', true),

    'driver' => env('JANTUNG_DRIVER', 'log'),

    'connections' => [
        'log' => [
            'path' => storage_path('logs/'),
        ],
        'http' => [
            'key' => env('JANTUNG_KEY'),
            'token' => env('JANTUNG_TOKEN'),
            'version' => env('JANTUNG_VERSION', 'v1'),
            'endpoint' => env('JANTUNG_ENDPOINT', 'https://jantung.zahir.my/api'),
        ],
    ],

    'observe' => [
        MessageLogged::class => [
            HandleExceptionEvent::class,
        ],
        QueryExecuted::class => [
            HandleQueryExecutedEvent::class,
        ],
        JobFailed::class => [
            HandleFailedJobEvent::class,
        ],
        RequestHandled::class => [
            HandleHttpRequestEvent::class,
        ],
        NotificationFailed::class => [
            HandleNotificationFailedEvent::class,
        ],
        CommandFinished::class => [
            HandleCommandEvent::class,
        ],
    ],

    'query' => [
        'slow-threshold' => env('JANTUNG_QUERY_SLOW_THRESHOLD', 500), // in miliseconds.
    ],

    'http' => [
        'hidden_request_headers' => [
            'authorization',
            'php-auth-pw',
        ],
        'hidden_parameters' => [
            'password',
            'password_confirmation',
        ],
        'hidden_response_parameters' => [],
        // https://developer.mozilla.org/en-US/docs/Web/HTTP/Status
        'ignored_status_codes' => [
            100, 101, 102, 103,
            200, 201, 202, 203, 204, 205, 206, 207,
            300, 302, 303, 304, 305, 306, 307, 308,
        ],
    ],
];
