<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        "/api/v1/auth/user",
        "/api/v1/users",
        "/api/v1/log-books",
        "api/v1/endorsements",
        "api/v1/applications",
        "api/v1/openings",
        "/api/v1/auth/user/*"
    ];
}
