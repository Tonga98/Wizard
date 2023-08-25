<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Camioneta extends Model
{
    use HasFactory;

    protected $table ='camionetas';
    protected $guarded=[];

    public static function proximosAVencer() {
        //Este metodo retorna las camionetas que faltan 1 mes o menos para vencer

        //Obtener la fecha del mes próximo
        $mesProximo = Carbon::now()->addMonth();

        $camionetas = Camioneta::where(function ($query) use ($mesProximo) {
            $query->whereDate('vtv_vencimiento', '<=', $mesProximo);
        })->get();

        return $camionetas;
    }

    public function camposAVencer(){
        //Este modulo retorna los campos a vencer de la camioneta

        //Obtener la fecha del mes próximo
        $mesProximo = Carbon::now()->addMonth();

        //Declaro array
        $campos = [];

        if($this->antecedentes_venc <= $mesProximo){
            $campos['VTV'] = $this->vtv_vencimiento;
        }
        return $campos;
    }

}
