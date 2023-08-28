<?php

namespace App\Services;
use App\Models\Chofer;
use ZipArchive;
class FileDownloadService
{
    public function downloadModelFiles($model, array $files):string{
        //Este metodo crea un zip con los archivos del modelo recibido y retorna el nombre del zip creado
        //$model: se refiere a un modelo el cual se descargaran sus archivos
        //$files: Se refiere a un array el cual contiene el nombre de los archivos y su path


        //Creo una instancia zip
        $zip = new ZipArchive();
        $zipName = $model->nombre . "-" . $model->apellido . ".zip";

        //Creo el zip y le agrego los archivos cargados en $files
        if ($zip->open($zipName, ZipArchive::CREATE)) {

            foreach ($files as $file) {
                $zip->addFile(storage_path($file['path']), $file['name']);
            }
            $zip->close();

        }
        return $zipName;
    }

    public function getFieldsWithFiles($model):array{
        //Este metodo retorna un array con los nombres y path de los archivos del modelo recibido

        //Declaracion variables
        $isChofer = false;
        $files = [];


        //Si es un model se debe verificar que contenga alguno de estos archivos
        if($model instanceof Chofer){
            $isChofer = true;
            //Campos de archivos que puede tener el model
            $camposFiles = [
                'dni_frente',
                'dni_dorso',
                'antecedentes_foto',
                'lic_conducir_frente',
                'lic_conducir_dorso'
            ];
        }else{
            //Si es una guarda se debe verificar que contenga alguno de estos archivos
            $camposFiles = [
                'dni_frente',
                'dni_dorso',
                'antecedentes_foto',
            ];
        }


        //Guardo en el array files los nombres de los archivos y sus rutas existentes
        foreach ($camposFiles as $file) {
            if ($model->$file != null) {
                $files[] = [
                    'name' => $file . "-" . $model->apellido . ".pdf",
                    'path' => ($isChofer ? 'app/choferes/' : 'app/guardas/') . $model->$file
                ];
            }
        }
        return $files;
    }
}
