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
use Illuminate\Http\Request;
use App\Models\Camioneta;
use App\Services\FileDownloadService;

class ChoferController extends Controller
{
    //Atributos
    protected FileDownloadService $fileDownloadService;

    //Metodos
    public function __construct(FileDownloadService $fileDownloadService){
        $this->fileDownloadService = $fileDownloadService;
    }

    public function create(): View
    {
        //Obtengo las camionetas para mostrarlas en el select
        $camionetas = Camioneta::all();
        return view('create.chofer', ['camionetas' => $camionetas]);
    }

    public function store(NewChoferRequest $request): RedirectResponse
    {

        //Obtengo todos los datos que estan correctamente validados
        $validatedData = $request->validated();

        //Creo array con los nombres de los archivos a recorrer
        $filesFields = ["antecedentes_foto", 'lic_conducir_frente', 'lic_conducir_dorso', 'dni_frente', 'dni_dorso'];
        $fileNames = [];

        foreach ($filesFields as $fileField) {

            //Si llego el campo con un archivo
            if (!empty($validatedData[$fileField])) {

                //Guardo el archivo en el storage
                $file = $validatedData[$fileField];
                $fileName = time() . '-' . $file->getClientOriginalName();
                $file->storeAs('choferes', $fileName);

                //Guardo los nombres de los campos input con el nombre del archivo guardado en el storage asociado
                $fileNames[$fileField] = $fileName;
            } else {
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

    public function index(): View
    {
        //Este modulo recupera los choferes de la db y los entrega a la vista

        //Declaracion de variables
        $choferes = [];
        $title = "Choferes";
        $link = "chofer";

        //Recupero todos los usuarios
        $choferes = Chofer::all();

        //Retorno vista home con lista de choferes
        return view('home', ['list' => $choferes, 'title' => $title, 'link' => $link]);
    }

    public function show(int $id): view
    {
        //Este metodo retorna el chofer de la db con id = $id

        //Obtengo el chofer
        $chofer = Chofer::find($id);

        //Obtengo la camioneta que maneja
        $camioneta = $chofer->camioneta;

        //Verifico si tiene archivos cargados para mostrar o no el boton de descargar archivos
        $hasFile = $chofer->hasFile();

        //Retorno la vista con el chofer
        return view('detail.chofer', ['chofer' => $chofer, 'camioneta' => $camioneta, 'hasFile' => $hasFile]);
    }

    public function edit(int $id): view
    {
        //Este metodo retorna la vista de editar chofer asociado al id recibido

        //Obtengo el chofer
        $chofer = Chofer::find($id);

        //Obtengo las camionetas para mostrarlas en el select
        $camionetas = Camioneta::all();

        //Retorno la vista con el chofer
        return view('create.chofer', ['chofer' => $chofer, 'edit' => true, 'camionetas' => $camionetas]);
    }

    public function update(UpdateChoferRequest $request, Chofer $chofer): RedirectResponse
    {

        //Obtengo los campos validados correctamente
        $validatedData = $request->validated();

        //Verifico si se actualizo la password
        if ($validatedData['password'] !== null) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        //Creo array con los nombres de los archivos a recorrer
        $filesFields = ["antecedentes_foto", 'lic_conducir_frente', 'lic_conducir_dorso', 'dni_frente', 'dni_dorso'];

        foreach ($filesFields as $fileField) {
            //Si llego el campo con un archivo
            if (!empty($validatedData[$fileField])) {

                //Elimino el archivo que tenia antes
                $oldFile = $chofer->$fileField;
                Storage::delete('choferes/' . $oldFile);

                //Guardo el nuevo archivo en el storage
                $file = $validatedData[$fileField];
                $fileName = time() . '-' . $file->getClientOriginalName();
                $file->storeAs('choferes', $fileName);
                $validatedData[$fileField] = $fileName;
            }
        }

        //Cargo los atributos en el modelo
        $chofer->update($validatedData);

        return redirect()->route('chofer.show', ['chofer' => $chofer->id]);
    }

    public function destroy(int $id): RedirectResponse
    {

        //Obtengo el chofer
        $chofer = Chofer::find($id);

        //Obtengo los nombres de los archivos asociados al chofer
        $archivosAEliminar = [
            $chofer->antecedentes_foto,
            $chofer->lic_conducir_frente,
            $chofer->lic_conducir_dorso,
            $chofer->dni_frente,
            $chofer->dni_dorso,
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

    public function eliminarArchivo(string $archivo, string $campo): RedirectResponse
    {
        //Este metodo elimina un archivo del storage con el nombre de $archivo

        //Obtengo el chofer
        $chofer = Chofer::where($campo, $archivo)->first();

        if ($chofer) {

            // Elimino el archivo del storage
            Storage::delete('choferes/' . $archivo);

            // Actualizo la base de datos
            $chofer->update([$campo => null]);
        }

        return back();
    }

    public function search(Request $request): View
    {
        //Este metodo busca choferes

        //Valido la request
        $request->validate(['search' => "required|string|max:255"]);

        $busqueda = $request->input('search');
        $title = "Choferes";
        $link = "chofer";

        // Realizar la búsqueda en la base de datos
        $list = Chofer::where('nombre', 'LIKE', "%$busqueda%")
            ->orWhere('ubicacion', 'LIKE', "%$busqueda%");

        //Retorno la lista de los choferes
        return view('home', ['list' => $list, 'title' => $title, 'link' => $link]);
    }

    public function downloadFiles(int $id): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        //Este metodo descarga todos los archivos cargados del chofer con el id recibido en un rar

        //Obtengo el chofer
        $chofer = Chofer::find($id);

        //Si no existe el chofer retorno
        if (!$chofer) {
            return abort(404, 'Chofer no encontrado');
        }

        //Obtengo los archivos y sus path que tenga cargados el chofer
        $files = $this->fileDownloadService->getFieldsWithFiles($chofer);

        //Si el chofer no tiene archivos a descargar
        if (count($files) === 0) {
            return abort(404, 'No hay archivos para descargar');
        }

        //Llamo al método del servicio para crear el zip con los archivos del chofer
        $zipName = $this->fileDownloadService->downloadModelFiles($chofer, $files);

        //Luego de descargar el zip lo elimino
        return response()
            ->download($zipName, null, ['Content-Type' => 'application/zip'])
            ->deleteFileAfterSend();
    }
}
