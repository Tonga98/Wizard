<?php

namespace App\Models;

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
}
