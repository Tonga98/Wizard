<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Middleware
{

    public function handle($request, Closure $next, ...$guards): Response
    {
        // Verificar si el usuario está autenticado en alguno de los guards especificados
        if (Auth::guard(...$guards)->check()) {
            return $next($request);
        }

        // Si el usuario no está autenticado, redirigir al login
        return redirect()->route('login');
    }


}
