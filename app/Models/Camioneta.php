<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    //Relacion one-to-one
    public function chofer() : HasOne
    {
        return $this->hasOne(Chofer::class,'id_camioneta', 'id');
    }

    //Relacion one-to-one
    public function guarda() : HasOne
    {
        //Como use la convencion de nombres de laravel, no tengo que especificar las columnas
        return $this->hasOne(Guarda::class);
    }

    //Relacion one-to-many
    public function pasajeros() : HasMany
    {
        return $this->hasMany(Pasajero::class);
    }

}
