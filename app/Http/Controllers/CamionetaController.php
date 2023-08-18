<?php

namespace App\Http\Controllers;

use App\Models\Camioneta;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CamionetaController extends Controller
{
    public function create(): View
    {
        return view('create.camioneta');
    }

    public function store(Request $request) : RedirectResponse
    {
        //Valido los datos
        $request->validate([
            'patente' => ['required', 'string', 'max:255', Rule::unique(Camioneta::class)],
            'vtv_vencimiento' => ['date'],
            'ubicacion' => ['required', 'string', 'max:255'],
        ]);

        //Paso la patente a mayusculas
        $patenteMayus = strtoupper($request->input('patente'));

        //Creo la camioneta
        $camioneta = Camioneta::create([
            'patente' => $patenteMayus,
            'ubicacion' => $request->ubicacion,
            'vtv_vencimiento' => $request->vtv_vencimiento,
        ]);

        event(new Registered($camioneta));

        return redirect(route('home'));
    }

    public function index() : View{
        //Este modulo recupera las camionetas de la db y los entrega a la vista

        //Declaracion de variables
        $camionetas = [];
        $title = "Camionetas";
        $link = "camioneta";

        //Recupero todos las camionetas
        $camionetas = Camioneta::paginate(10);

        //Retorno vista home con lista de camionetas
        return view('home',['list'=> $camionetas, 'title'=>$title, 'link' =>$link]);
    }

    public function show(int $id): view{

        //Obtengo el pasajero
        $camioneta = Camioneta::find($id);


        return view('detail.camioneta', ['camioneta'=> $camioneta]);
    }

    public function edit(int $id):view{

        //Obtengo la camioneta
        $camioneta = Camioneta::find($id);

        return view('create.camioneta', ['camioneta'=>$camioneta, 'edit'=>true]);
    }

    public function update(Request $request, Camioneta $camioneta)
    {
        //Valido los datos
        $request->validate([
            'patente' => [ 'string', 'max:255', Rule::unique(Camioneta::class)->ignore($camioneta->id)],
            'vtv_vencimiento' => ['date'],
            'ubicacion' => ['string', 'max:255'],
        ]);

        //Actualizo los datos de la camioneta, utilizo el metodo all para pasar los datos en array
        $camioneta->update($request->all());

        return redirect()->route('camioneta.show',['camioneta'=>$camioneta->id]);
    }

    public function destroy(int $id):RedirectResponse{

        //Obtengo el chofer
        $camioneta = Camioneta::find($id);

        //Elimino el chofer
        $camioneta->delete();

        return redirect(route('camioneta.index'));
    }

    public function search(Request $request) :View{
        //Este metodo busca camionetas

        //Valido la request
        $request->validate(['search'=> "required|string|max:255"]);

        $busqueda = $request->input('search');
        $title = "Camionetas";
        $link ="camioneta";

        // Realizar la búsqueda en la base de datos
        $list = Camioneta::where('patente', 'LIKE', "%$busqueda%")
            ->orWhere('ubicacion', 'LIKE', "%$busqueda%")
            ->paginate(10);

        //Retorno la lista de los choferes
        return view('home',['list'=> $list, 'title'=>$title, 'link'=>$link]);
    }
}
