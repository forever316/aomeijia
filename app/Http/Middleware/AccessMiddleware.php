<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Session;

class AccessMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        $response->header('Access-Control-Allow-Origin', '*');
        $response->header('Access-Control-Allow-Headers', 'Origin, Content-Type, Cookie, Accept, multipart/form-data, application/json');
        $response->header('Access-Control-Allow-Methods', 'GET, POST, PATCH, PUT, OPTIONS');
        $response->header('Access-Control-Allow-Credentials', 'false');
        return $response;
    }
}