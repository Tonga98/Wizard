<?php

namespace App\Http\Controllers;

use App\Models\Guarda;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use App\Http\Requests\NewGuardaRequest;
use App\Http\Requests\UpdateGuardaRequest;
use Storage;

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

        //Creo array con los nombres de los archivos a recorrer
        $filesFields = ["antecedentes_foto", 'dni_frente', 'dni_dorso'];
        $fileNames=[];

        foreach ($filesFields as $fileField){

            //Si llego el campo con un archivo
            if(!empty($validatedData[$fileField])){

                //Guardo el archivo en el storage
                $file = $validatedData[$fileField];
                $fileName = time().'-'.$file->getClientOriginalName();
                $file->storeAs('guardas', $fileName);

                //Guardo los nombres de los campos input con el nombre del archivo guardado en el storage asociado
                $fileNames[$fileField] = $fileName;
            }else{
                $validatedData[$fileField] = null;
            }

        }

        $user = Guarda::create([
            'ubicacion' => $validatedData['ubicacion'],
            'num_telefono' => $validatedData['num_telefono'],
            'antecedentes_foto' => $fileNames['antecedentes_foto'] ?? null,
            'antecedentes_venc' => $validatedData['antecedentes_venc'],
            'dni_frente' => $fileNames['dni_frente'] ?? null,
            'dni_dorso' => $fileNames['dni_dorso'] ?? null,
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
        $guardas = Guarda::paginate(10);

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

        //Creo array con los nombres de los archivos a recorrer
        $filesFields = ["antecedentes_foto", 'dni_frente', 'dni_dorso'];

        foreach ($filesFields as $fileField){
            //Si llego el campo con un archivo
            if(!empty($validatedData[$fileField])){

                //Elimino el archivo que tenia antes
                $oldFile = $guarda->$fileField;
                Storage::delete('guardas/'.$oldFile);

                //Guardo el nuevo archivo en el storage
                $file = $validatedData[$fileField];
                $fileName = time().'-'.$file->getClientOriginalName();
                $file->storeAs('guardas', $fileName);
                $validatedData[$fileField] = $fileName;
            }
        }

        //Actualizo los datos de la guarda
        $guarda->update($validatedData);

        return redirect()->route('guarda.show',['guarda'=>$guarda->id]);

    }

    public function destroy(int $id):RedirectResponse{

        //Obtengo la guarda
        $guarda = Guarda::find($id);

        //Obtengo los nombres de los archivos asociados a la guarda
        $archivosAEliminar = [
            $guarda->antecedentes_foto ,
            $guarda->dni_frente ,
            $guarda->dni_dorso ,
        ];

        //Elimino la guarda
        $guarda->delete();

        //Elimino los archivos del almacenamiento
        foreach ($archivosAEliminar as $archivo) {
            if (!empty($archivo)) {
                Storage::delete('guardas/' . $archivo);
            }
        }

        return redirect(route('guarda.index'));
    }

    public function eliminarArchivo(String $archivo, String $campo):RedirectResponse{
        //Este metodo elimina un archivo del storage con el nombre de $archivo

        //Obtengo la guarda
        $guarda = Guarda::where($campo, $archivo)->first();

        if ($guarda) {

            // Elimino el archivo del storage
            Storage::delete('guardas/'.$archivo);

            // Actualizo la base de datos
            $guarda->update([$campo => null]);
        }

        return back();
    }
}
