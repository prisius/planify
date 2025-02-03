<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && $request->user()->isAdmin == 1) {
            return $next($request);
        }

        // If not an admin, return a 403 response
        return response()->json(['error' => 'Forbidden'], 403);
    }
}