<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiJsonRequestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->isJson())
            return response()->json([
                'error' => 'Invalid payload',
                'description' => 'The payload must be json',
            ], 400);
        $json = $request->json()->all();
        $request->attributes->add(['json_body' => $json]);
        return $next($request);
    }
}
