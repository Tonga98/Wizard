<?php

namespace App\Http\Controllers;

use App\Models\Pasajero;
use Illuminate\Auth\Events\Registered;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PasajeroController extends Controller
{
    public function create(): View
    {
        return view('create.pasajero');
    }

    public function store(Request $request)
    {
        //Valido los datos
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'ubicacion' => ['required', 'string', 'max:255'],
            'num_telefono' => ['required', 'integer', Rule::unique(Pasajero::class)],
        ]);

        //Creo el pasajero
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
        $link = "pasajero";

        //Recupero todos los pasajeros
        $pasajeros = Pasajero::all();

        //Retorno vista home con lista de pasajeros
        return view('home',['list'=> $pasajeros, 'title'=>$title, 'link' => $link]);
    }

    public function show(int $id): view{

        //Obtengo el pasajero
        $pasajero = Pasajero::find($id);

        //Obtengo la camioneta en la que viaja
        $camioneta = $pasajero->camioneta;

        return view('detail.pasajero', ['pasajero' => $pasajero, 'camioneta'=> $camioneta]);
    }

    public function edit(int $id):view{

        //Obtengo el pasajero
        $pasajero = Pasajero::find($id);

        return view('create.pasajero', ['pasajero'=>$pasajero, 'edit'=>true]);
    }
}
