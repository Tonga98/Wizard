<?php

namespace App\Http\Controllers;

use App\Models\Camioneta;
use Illuminate\Auth\Events\Registered;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CamionetaController extends Controller
{
    public function create(): View
    {
        return view('create.camioneta');
    }

    public function store(Request $request)
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
        $camionetas = Camioneta::all();

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
}
