<?php

namespace App\Http\Controllers;

use App\Models\Pasajero;
use Egulias\EmailValidator\Result\Reason\UnclosedQuotedString;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\Internal\PhpStormStubsElementAvailable;

class PasajeroController extends Controller
{
    public function create(): View
    {
        return view('create.pasajero');
    }

    public function store(Request $request): RedirectResponse
    {
        //Valido los datos
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'ubicacion' => ['required', 'string', 'max:255'],
            'num_telefono' => ['required', 'integer', Rule::unique(Pasajero::class)],
            'camioneta_id'=> ['required']
        ]);

        //Creo el pasajero
        $user = Pasajero::create([
            'ubicacion' => $request->ubicacion,
            'num_telefono' => $request->num_telefono,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'camioneta_id' => $request->camioneta_id,
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

    public function update(Request $request, Pasajero $pasajero): RedirectResponse{

        //Valido los datos
        $request->validate([
            'nombre' => [ 'string', 'max:255'],
            'apellido' => [ 'string', 'max:255'],
            'ubicacion' => [ 'string', 'max:255'],
            'num_telefono' => [ 'integer', Rule::unique(Pasajero::class)->ignore($pasajero->id)],
            'camioneta_id' => ['integer'],
        ]);

        //Actualizo los datos del pasajero, utilizo el metodo all para pasar los datos en array
        $pasajero->update($request->all());

        return redirect()->route('pasajero.show',['pasajero'=>$pasajero->id]);

    }

    public function destroy(int $id):RedirectResponse{

        //Obtengo el chofer
        $pasajero = Pasajero::find($id);

        //Elimino el chofer
        $pasajero->delete();

        return redirect(route('pasajero.index'));
    }
}
