<?php

namespace App\Http\Controllers;

use App\Models\Guarda;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use App\Http\Requests\NewGuardaRequest;
use App\Http\Requests\UpdateGuardaRequest;
use Storage;
use App\Models\Camioneta;
use ZipArchive;
use App\Services\FileDownloadService;

class GuardaController extends Controller
{
    //Atributos
    protected FileDownloadService $fileDownloadService;

    //Metodos
    public function __construct(FileDownloadService $fileDownloadService)
    {
        $this->fileDownloadService = $fileDownloadService;
    }

    public function create(): View
    {
        //Obtengo las camionetas para mostrarlas en el select
        $camionetas = Camioneta::all();

        return view('create.guarda', ['camionetas' => $camionetas]);
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

        return redirect()->route('guarda.show',['guarda'=>$user->id]);
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

        //Verifico si tiene archivos cargados para mostrar o no el boton de descargar archivos
        $hasFile = $guarda->hasFile();

        return view('detail.guarda', ['guarda'=>$guarda, 'camioneta' => $camioneta, 'hasFile'=>$hasFile]);
    }

    public function edit(int $id): view{
        //id se refiere al id de la guarda a editar

        //Obtengo la guarda
        $guarda = Guarda::find($id);

        //Obtengo las camionetas para mostrarlas en el select
        $camionetas = Camioneta::all();

        return view('create.guarda', ['guarda'=>$guarda, 'edit'=>true, 'camionetas'=>$camionetas]);
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

    public function search(Request $request) :View{
        //Este metodo busca guardas

        //Valido la request
        $request->validate(['search'=> "required|string|max:255"]);

        $busqueda = $request->input('search');
        $title = "Guardas";
        $link ="guarda";

        // Realizar la búsqueda en la base de datos
        $list = Guarda::where('nombre', 'LIKE', "%$busqueda%")
            ->orWhere('ubicacion',  'LIKE', "%$busqueda%")->get();

        //Retorno la lista de los choferes
        return view('home',['list'=> $list, 'title'=>$title, 'link'=>$link]);
    }

    public function downloadFiles(int $id)
    {
        //Este metodo descarga todos los archivos cargados de la guarda con el id recibido

        //Obtengo el guarda
        $guarda = Guarda::find($id);

        //Si no existe el guarda retorno
        if (!$guarda) {
            return abort(404, 'Guarda no encontrada');
        }

        //Obtengo los archivos y sus path que tenga cargados el chofer
        $files = $this->fileDownloadService->getFieldsWithFiles($guarda);

        //Si la guarda no tiene archivos a descargar
        if (count($files) === 0) {
            return abort(404, 'No hay archivos para descargar');
        }

        //Llamo al método del servicio para crear el zip con los archivos de la guarda
        $zipName = $this->fileDownloadService->downloadModelFiles($guarda, $files);

        //Luego de descargar el zip lo elimino
        return response()
            ->download($zipName, null, ['Content-Type' => 'application/zip'])
            ->deleteFileAfterSend();
    }
}
