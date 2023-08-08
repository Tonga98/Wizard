<?php

namespace App\Http\Controllers;

use App\Models\Camioneta;
use Illuminate\Auth\Events\Registered;
use Illuminate\View\View;
use Illuminate\Http\Request;

class CamionetaController extends Controller
{
    public function create(): View
    {
        return view('create.camioneta');
    }

    public function store(Request $request)
    {
        $request->validate([
            'patente' => ['required', 'string', 'max:255'],
            'vtv_vencimiento' => ['date'],
            'ubicacion' => ['required', 'string', 'max:255'],
        ]);

        //Paso la patente a mayusculas
        $patenteMayus = strtoupper($request->input('patente'));

        $user = Camioneta::create([
            'patente' => $patenteMayus,
            'ubicacion' => $request->ubicacion,
            'vtv_vencimiento' => $request->vtv_vencimiento,
        ]);

        event(new Registered($user));

        return redirect(route('home'));
    }

    public function index() : View{
        //Este modulo recupera las camionetas de la db y los entrega a la vista

        //Declaracion de variables
        $camionetas = [];
        $title = "Camionetas";

        //Recupero todos las camionetas
        $camionetas = Camioneta::all();

        //Retorno vista home con lista de camionetas
        return view('home',['list'=> $camionetas, 'title'=>$title]);
    }
}
