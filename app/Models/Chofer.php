<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Camioneta;

class Chofer extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    //Tabla que utiliza el modelo
    protected $table = "choferes";

    //Atributos que no puedo llenar al crear un modelo
    protected $guarded = ['admin'];

    //Asigno de que tipo tienen que ser ciertos datos
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    //Atributos que nunca deberia entregar al usuario
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function camioneta(){
        //Este metodo obtiene y retorna la camioneta que maneja el chofer

        return $this->belongsTo(Camioneta::class, 'id_camioneta');
    }

}




