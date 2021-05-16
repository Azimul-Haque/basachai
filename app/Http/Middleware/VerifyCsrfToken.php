<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'dashboard.attendance.test',
        '/onesignal/post/question/api',
        '/onesignal/report/question/api',
        '/onesignal/contact/api',
    ];
}
