<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    public function handle(Request $request, Closure $next): Response
    {
        // Verificar si el usuario ha iniciado sesión
        if (Auth::check()) {
            // Obtener el usuario autenticado
            $user = Auth::user();
            // Verificar el tipo de usuario (por ejemplo, role_id == 3 para el usuario)
            if ($user->role_id == 3) {
                // Usuario continua con la solicitud
                return $next($request);
            }
        }
        // Si no es un usuario, redirigir al dashboard
        return redirect('/dashboard');
    }
}
