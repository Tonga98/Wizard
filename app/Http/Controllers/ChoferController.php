<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateChoferRequest;
use App\Models\Chofer;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use App\Http\Requests\NewChoferRequest;
use Storage;

class ChoferController extends Controller
{
    public function create(): View

    {
        return view('create.chofer');
    }

    public function store(NewChoferRequest $request): RedirectResponse
    {

        //Obtengo todos los datos que estan correctamente validados
        $validatedData = $request->validated();

        //Creo array con los nombres de los archivos a recorrer
        $filesFields = ["antecedentes_foto", 'lic_conducir_frente', 'lic_conducir_dorso', 'dni_frente', 'dni_dorso'];
        $fileNames=[];

        foreach ($filesFields as $fileField){

            //Si llego el campo con un archivo
            if(!empty($validatedData[$fileField])){

                //Guardo el archivo en el storage
                $file = $validatedData[$fileField];
                $fileName = time().'-'.$file->getClientOriginalName();
                $file->storeAs('choferes', $fileName);

                //Guardo los nombres de los campos input con el nombre del archivo guardado en el storage asociado
                $fileNames[$fileField] = $fileName;
            }else{
                $validatedData[$fileField] = null;
            }

        }



        //Creo el nuevo chofer
        $user = Chofer::create([
            'ubicacion' => $validatedData['ubicacion'],
            'num_telefono' => $validatedData['num_telefono'],
            'antecedentes_foto' => $fileNames['antecedentes_foto'] ?? null,
            'antecedentes_venc' => $validatedData['antecedentes_venc'],
            'lic_conducir_venc' => $validatedData['lic_conducir_venc'],
            'lic_conducir_frente' => $fileNames['lic_conducir_frente'] ?? null,
            'lic_conducir_dorso' => $fileNames['lic_conducir_dorso'] ?? null,
            'linti_venc' => $validatedData['linti_venc'],
            'dni_frente' => $fileNames['dni_frente'] ?? null,
            'dni_dorso' => $fileNames['dni_dorso'] ?? null,
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
        $choferes = Chofer::simplePaginate(10);

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

        //Creo array con los nombres de los archivos a recorrer
        $filesFields = ["antecedentes_foto", 'lic_conducir_frente', 'lic_conducir_dorso', 'dni_frente', 'dni_dorso'];

        foreach ($filesFields as $fileField){
            //Si llego el campo con un archivo
            if(!empty($validatedData[$fileField])){

                //Elimino el archivo que tenia antes
                $oldFile = $chofer->$fileField;
                Storage::delete('choferes/'.$oldFile);

                //Guardo el nuevo archivo en el storage
                $file = $validatedData[$fileField];
                $fileName = time().'-'.$file->getClientOriginalName();
                $file->storeAs('choferes', $fileName);
                $validatedData[$fileField] = $fileName;
            }
        }

        //Cargo los atributos en el modelo
        $chofer->update($validatedData);

        return redirect()->route('chofer.show',['chofer'=>$chofer->id]);
    }

    public function destroy(int $id):RedirectResponse{

        //Obtengo el chofer
        $chofer = Chofer::find($id);

        //Obtengo los nombres de los archivos asociados al chofer
        $archivosAEliminar = [
            $chofer->antecedentes_foto ,
            $chofer->lic_conducir_frente,
            $chofer->lic_conducir_dorso,
            $chofer->dni_frente ,
            $chofer->dni_dorso ,
        ];

        //Elimino el chofer
        $chofer->delete();

        //Elimino los archivos del almacenamiento
        foreach ($archivosAEliminar as $archivo) {
            if (!empty($archivo)) {
                Storage::delete('choferes/' . $archivo);
            }
        }

        return redirect(route('chofer.index'));
    }

    public function eliminarArchivo(String $archivo, String $campo):RedirectResponse{
        //Este metodo elimina un archivo del storage con el nombre de $archivo

        //Obtengo el chofer
        $chofer = Chofer::where($campo, $archivo)->first();

        if ($chofer) {

          // Elimino el archivo del storage
            Storage::delete('choferes/'.$archivo);

          // Actualizo la base de datos
            $chofer->update([$campo => null]);
        }

        return back();
    }
}
