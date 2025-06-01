<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Input;
use Illuminate\Session\TokenMismatchException;

class VerifyCsrfToken
{
    public function handle($request, Closure $next)
    {
        // Check if the request is coming from a POST method
        if ($request->isMethod('post')) {
            // Get the CSRF token from the request
            $token = $request->input('_token');

            // Get the CSRF token from the session
            $sessionToken = $request->session()->token();

            // Verify if the tokens match
            if (!hash_equals($sessionToken, $token)) {
                throw new TokenMismatchException();
            }
        }

        return $next($request);
    }
}
