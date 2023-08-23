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

        //Choferes con algun papel vencido o por vencer
        $vencidos = Chofer::proximosAVencer();

        //Creo un arreglo para los datos a pasar a la vista
        $data = [];

        foreach ($vencidos as $chofer) {
            $data[] = [
                'model' => $chofer,
                'camposVencidos' => $chofer->camposAVencer(),
            ];
        }

        return view('home', ['vencidos' =>$data]);
    }

}

