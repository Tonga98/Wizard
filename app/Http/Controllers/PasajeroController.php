<?php

namespace App\Http\Controllers;

use App\Models\Pasajero;
use Illuminate\Auth\Events\Registered;
use Illuminate\View\View;
use Illuminate\Http\Request;

class PasajeroController extends Controller
{
    public function create(): View
    {
        return view('create.pasajero');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'ubicacion' => ['required', 'string', 'max:255'],
            'num_telefono' => ['required', 'integer'],
        ]);


        $user = Pasajero::create([
            'ubicacion' => $request->ubicacion,
            'num_telefono' => $request->num_telefono,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'camioneta_id' => $request->id_camioneta,
        ]);

        event(new Registered($user));

        return redirect(route('home'));
    }

    public function index() : View{
        //Este modulo recupera los pasajeros de la db y los entrega a la vista

        //Declaracion de variables
        $pasajeros = [];
        $title = "Pasajeros";

        //Recupero todos los pasajeros
        $pasajeros = Pasajero::all();

        //Retorno vista home con lista de pasajeros
        return view('home',['list'=> $pasajeros, 'title'=>$title]);
    }
}
