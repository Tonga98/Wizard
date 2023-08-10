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
        //Obtengo todos los datos que estan correctamente validados
        $validatedData = $request->validated();

        $user = Guarda::create([
            'ubicacion' => $validatedData['ubicacion'],
            'num_telefono' => $validatedData['num_telefono'],
            'antecedentes_foto' => $validatedData['antecedentes_foto'] ?? '',
            'antecedentes_venc' => $validatedData['antecedentes_venc'],
            'dni_frente' => $validatedData['dni_frente'] ?? '',
            'dni_dorso' => $validatedData['dni_dorso'] ?? '',
            'nombre' => $validatedData['nombre'],
            'apellido' => $validatedData['apellido'],
            'camioneta_id' => $validatedData['id_camioneta'],
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
        $guardas = [];
        $title = "Guardas";
        $link = "guarda";

        //Recupero todos los usuarios
        $guardas = Guarda::all();

        //Retorno vista home con lista de choferes
        return view('home',['list'=> $guardas, 'title'=>$title, 'link'=>$link]);
    }

    public function show(int $id): view{
        //Este metodo retorna la guarda con el id = $id

        //Obtengo la guarda de la db
        $guarda = Guarda::find($id);

        //Obtengo la camioneta en la cual anda la guarda
        $camioneta = $guarda->camioneta;

        return view('detail.guarda', ['guarda'=>$guarda, 'camioneta' => $camioneta]);
    }

    public function edit(int $id): view{
        //id se refiere al id de la guarda a editar

        //Obtengo la guarda
        $guarda = Guarda::find($id);

        return view('create.guarda', ['guarda'=>$guarda, 'edit'=>true]);
    }
}
