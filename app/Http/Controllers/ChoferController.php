<?php

namespace App\Http\Controllers;

use App\Models\Chofer;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use App\Http\Requests\NewChoferRequest;

class ChoferController extends Controller
{
    public function create(): View
    {
        return view('create.chofer');
    }

    public function store(NewChoferRequest $request)
    {


        $user = Chofer::create([
            'ubicacion' => $request->ubicacion,
            'num_telefono' => $request->num_telefono,
            'antecedentes_foto' => $request->antecedentes_foto,
            'antecedentes_venc' => $request->antecedentes_venc,
            'lic_conducir_venc' => $request->lic_conducir_venc,
            'lic_conducir_frente' => $request->lic_conducir_frente,
            'lic_conducir_dorso' => $request->lic_conducir_dorso,
            'linti_venc' => $request->linti_venc,
            'dni_frente' => $request->dni_frente,
            'dni_dorso' => $request->dni_dorso,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'id_camioneta' => $request->id_camioneta,
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
        $choferes = [];
        $title = "Choferes";

        //Recupero todos los usuarios
        $choferes = Chofer::all();

        //Retorno vista home con lista de choferes
        return view('home',['list'=> $choferes, 'title'=>$title]);
    }

    public function show(int $id): view{
        //Este metodo retorna el chofer de la db con id = $id

        //Obtengo el chofer
        $chofer = Chofer::find($id);

        //Obtengo la camioneta que maneja
        $camioneta = $chofer->camioneta;

        //Retorno la vista con el chofer
        return view('detail.chofer',['chofer' => $chofer, 'camioneta'=>$camioneta]);
    }

    public function edit(int $id): view{
        //Este metodo retorna la vista de editar chofer asociado al id recibido

        //Obtengo el chofer
        $chofer = Chofer::find($id);

        //Retorno la vista con el chofer
        return view('edit.chofer',['chofer'=>$chofer]);
    }

    public function update(){

    }
}
