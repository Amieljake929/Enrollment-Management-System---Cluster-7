<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
{
    $key = 'REGISTRAR_STUDENT_INFO'; // Pwedeng ilagay ito sa .env file para mas safe
    
    if ($request->header('x-api-key') !== $key) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    return $next($request);
}
}
