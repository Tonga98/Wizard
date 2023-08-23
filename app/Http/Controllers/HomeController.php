<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Chofer;
use App\Models\Guarda;
use App\Models\Camioneta;
use Illuminate\View\View;

class HomeController extends Controller
{
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

}

