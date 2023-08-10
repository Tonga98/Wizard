<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateChoferRequest;
use App\Models\Chofer;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
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

        //Obtengo todos los datos que estan correctamente validados
        $validatedData = $request->validated();

        //Creo el nuevo chofer
        $user = Chofer::create([
            'ubicacion' => $validatedData['ubicacion'],
            'num_telefono' => $validatedData['num_telefono'],
            'antecedentes_foto' => $validatedData['antecedentes_foto'] ?? '',
            'antecedentes_venc' => $validatedData['antecedentes_venc'],
            'lic_conducir_venc' => $validatedData['lic_conducir_venc'],
            'lic_conducir_frente' => $validatedData['lic_conducir_frente'] ?? '',
            'lic_conducir_dorso' => $validatedData['lic_conducir_dorso'] ?? '',
            'linti_venc' => $validatedData['linti_venc'],
            'dni_frente' => $validatedData['dni_frente'] ?? '',
            'dni_dorso' => $validatedData['dni_dorso'] ?? '',
            'nombre' => $validatedData['nombre'],
            'apellido' => $validatedData['apellido'],
            'id_camioneta' => $validatedData['id_camioneta'],
            'dni_num' => $validatedData['dni_num'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        event(new Registered($user));

        return redirect(route('home'));
    }

    public function index() : View{
        //Este modulo recupera los choferes de la db y los entrega a la vista

        //Declaracion de variables
        $choferes = [];
        $title = "Choferes";
        $link ="chofer";

        //Recupero todos los usuarios
        $choferes = Chofer::all();

        //Retorno vista home con lista de choferes
        return view('home',['list'=> $choferes, 'title'=>$title, 'link'=>$link]);
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
        return view('create.chofer',['chofer'=>$chofer, 'edit'=>true]);
    }

    public function update(UpdateChoferRequest $request, Chofer $chofer): RedirectResponse{

        //Obtengo los campos validados correctamente
        $validatedData = $request->validated();

        //Verifico si se actualizo la password
        if($validatedData['password'] !== null){
            $validatedData['password'] = Hash::make($validatedData['password']);
        }else{
            unset($validatedData['password']);
        }

        //Cargo los atributos en el modelo
        $chofer->update($validatedData);

        return redirect()->route('chofer.show',['chofer'=>$chofer->id]);
    }
}
