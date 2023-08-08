<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Chofer;
use App\Models\Guarda;

class LoginController extends Controller
{


    //Se muestra la pantalla de login
    public function showLogin(): View
    {
        return view('auth.login');
    }

    //Se verifica el inicio de sesion
    public function store(LoginRequest $request){

        $credentials = $request->only('dni_num', 'password');

        //Verifico los datos de inicio de sesion sean correctos

        // Consulta la tabla "choferes"
        $chofer = Chofer::where('dni_num', $credentials['dni_num'])
            ->where('password', $credentials['password'])
            ->first();

        if ($chofer) {
            Auth::login($chofer);
            $request->session()->regenerate();
            return redirect()->intended(route('home'));
        }

        // Consulta la tabla "guardas"
        $guarda = Guarda::where('dni_num', $credentials['dni_num'])
            ->where('password', $credentials['password'])
            ->first();

        if ($guarda) {
            Auth::login($guarda);
            $request->session()->regenerate();
            return redirect()->intended(route('home'));
        }


        // Si no encontró coincidencias en ninguna tabla, mostrar un mensaje de error
        return redirect()->route('login')->withErrors([
            'login' => 'The provided credentials do not match our records.',
        ], 401);
    }
}
