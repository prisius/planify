<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class CheckIfAdminExists
{
public function handle(Request $request, Closure $next)
{
    // Si aucun admin n'existe et que l'utilisateur n'est pas déjà sur la page de configuration
    if (User::where('isAdmin', 1)->doesntExist() && !$request->is('admin-setup')) {
        return redirect()->route('admin.setup');
    }

    return $next($request);
}
public function show(){
    return view('admin.hello');
}
}
