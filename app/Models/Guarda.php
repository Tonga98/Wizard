<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Camioneta;

class Guarda extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    //Tabla que utiliza el modelo
    protected $table = "guardas";

    //Asigno de que tipo tienen que ser ciertos datos
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    protected $guarded = [];

    //Atributos que nunca deberia entregar al usuario
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function camioneta(){
        //Este metodo retorna la camioneta en la que trabaja la guarda
        return $this->belongsTo(Camioneta::class, 'camioneta_id');
    }

    public static function proximosAVencer(): array {
        //Este metodo retorna las guardas que faltan 1 mes o menos para vencer

        //Obtener la fecha del mes próximo
        $mesProximo = Carbon::now()->addMonth();

        return Guarda::where(function ($query) use ($mesProximo) {
            $query->whereDate('lic_conducir_venc', '<=', $mesProximo)
                ->orWhereDate('antecedentes_venc', '<=', $mesProximo)
                ->orWhereDate('linti_venc', '<=', $mesProximo);
        })->get();
    }
}
