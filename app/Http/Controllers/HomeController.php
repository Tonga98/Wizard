<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Chofer;
use App\Models\Guarda;
use App\Models\Camioneta;
use Illuminate\View\View;
use App\Services\FileDownloadService;
use ZipArchive;

class HomeController extends Controller
{
    //Atributos
    protected $fileDownloadService;

    //Metodos
    public function __construct(FileDownloadService $fileDownloadService)
    {
        $this->fileDownloadService = $fileDownloadService;
    }

    public function index() : View{
        //Este metodo muestra la pagina principal con una lista de los elementos proximos a vencer de los modelos

        //Algún papel vencido o por vencer
        $vencidosChoferes = Chofer::proximosAVencer();
        $vencidosCamionetas = Camioneta::proximosAVencer();
        $vencidosGuardas = Guarda::proximosAVencer();

        // Combino las colecciones de vencidos
        $vencidos = $vencidosChoferes->concat($vencidosCamionetas)->concat($vencidosGuardas);


        //Creo un arreglo para los datos a pasar a la vista
        $data = [];

        foreach ($vencidos as $model) {
            $data[] = [
                'model' => $model,
                'camposVencidos' => $model->camposAVencer(),
            ];
        }

        return view('home', ['vencidos' =>$data]);
    }

    public function downloadAllFiles(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        //Este metodo descarga todos los archivos de los choferes y las guardas en dos subcarpetas dentro de un rar

        //Obtengo coleccion de choferes y guardas con algun archivo cargado
        $choferes = Chofer::withFilesLoaded();
        $guardas = Guarda::withFilesLoaded();
        $models = $choferes->concat($guardas);


        if(empty($models)){
            return abort(404, 'No se encontraron choferes o guardas con archivos');
        }

        //Creo una instancia zip para el zipGeneral
        $zipGeneral = new ZipArchive();
        $zipName =  "Todos los archivos.zip";

        //Declaro $zipNameList para guardar los nombres de los zip individuales y luego eliminarlos
        $zipNameList = [];

        //Creo el zipGeneral general y le agrego todos los archivos en subcarpetas
        if ($zipGeneral->open($zipName, ZipArchive::CREATE)) {

            //Recorro cada modelo y por cada modelo creo una subcarpeta con su nombre que contendra sus archivos
            foreach ($models as $model) {

                //Obtengo los campos del modelo que tienen cargado un archivo
                $fields = $this->fileDownloadService->getFieldsWithFiles($model);

                //Creo el zip del modelo y obtengo el nombre asi luego elimino el zip
                $zipNameModel = $this->fileDownloadService->downloadModelFiles($model, $fields);
                $zipNameList[] = $zipNameModel;

                //Guardo el zipGeneral del model en el zipGeneral general
                $zipGeneral->addFile(public_path($zipNameModel), $zipNameModel);
            }
            $zipGeneral->close();
        }

        // Utilizo el evento "terminable" para eliminar los archivos individuales después de que se haya completado la respuesta HTTP
        app()->terminating(function() use ($zipNameList) {
            foreach ($zipNameList as $item) {
                unlink(public_path($item));
            }
        });

        //Luego de descargar el zipGeneral lo elimino
        return response()
            ->download($zipName, null, ['Content-Type' => 'application/zipGeneral'])
            ->deleteFileAfterSend();
    }

}

