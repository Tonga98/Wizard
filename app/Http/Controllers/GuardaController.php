<?php

namespace App\Http\Controllers;

use App\Models\Guarda;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use App\Http\Requests\NewGuardaRequest;
use App\Http\Requests\UpdateGuardaRequest;

class GuardaController extends Controller
{
    public function create(): View
    {
        return view('create.guarda');
    }

    public function store(NewGuardaRequest $request) : RedirectResponse
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
            'camioneta_id' => $validatedData['camioneta_id'],
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

    public function update(UpdateGuardaRequest $request, Guarda $guarda) : RedirectResponse{

        //Obtengo los datos validados correctamente
        $validatedData = $request->validated();

        //Verifico si cambio la password la actualizo
        if($validatedData['password'] !== null){
            $validatedData['password'] = Hash::make($validatedData['password']);
        }else{
            unset($validatedData['password']);
        }

        //Actualizo los datos de la guarda
        $guarda->update($validatedData);

        return redirect()->route('guarda.show',['guarda'=>$guarda->id]);

    }

    public function destroy(int $id):RedirectResponse{

        //Obtengo la guarda
        $guarda = Guarda::find($id);

        //Elimino la guarda
        $guarda->delete();

        return redirect(route('guarda.index'));
    }
}
