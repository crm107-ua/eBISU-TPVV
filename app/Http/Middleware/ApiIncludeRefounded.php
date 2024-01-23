<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiIncludeRefounded
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $includeRefound = $request->input('includeRefound', 'false');
        if ($includeRefound != 'true' && $includeRefound != 'false') {
            return response()->json([
                'error' => 'Invalid request',
                'description' => "'includeRefound' must be true or false, but '$includeRefound' was provided",
            ], 400);
        }
        $includeRefound = $includeRefound == 'true';
        $request->attributes->add(['include_refounded' => $includeRefound]);
        return $next($request);
    }
}
