<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
//        'http://localhost:8000/searchTest2',
//        'http://localhost:8000//live_search/',
//        'http://localhost:8000//live_search/action',
//        '/searchTest2',
//        '/live_search/',
//        '/live_search/action',

    ];
}
