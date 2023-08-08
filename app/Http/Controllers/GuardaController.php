<?php

namespace App\Http\Controllers;

use App\Models\Guarda;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use App\Http\Requests\NewGuardaRequest;

class GuardaController extends Controller
{
    public function create(): View
    {
        return view('create.guarda');
    }

    public function store(NewGuardaRequest $request)
    {
        $user = Guarda::create([
            'ubicacion' => $request->ubicacion,
            'num_telefono' => $request->num_telefono,
            'antecedentes_foto' => $request->antecedentes_foto,
            'antecedentes_venc' => $request->antecedentes_venc,
            'dni_frente' => $request->dni_frente,
            'dni_dorso' => $request->dni_dorso,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'camioneta_id' => $request->id_camioneta,
            'dni_num' => $request->dni_num,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        return redirect(route('home'));
    }

    public function index() : View{
        //Este modulo recupera los choferes de la db y los entrega a la vista

        //Declaracion de variables
        $guardas = [];
        $title = "Guardas";

        //Recupero todos los usuarios
        $guardas = Guarda::all();

        //Retorno vista home con lista de choferes
        return view('home',['list'=> $guardas, 'title'=>$title]);
    }
}
