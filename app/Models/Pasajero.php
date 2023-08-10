<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Camioneta;

class Pasajero extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    //Tabla que utiliza el modelo
    protected $table = "pasajeros";

    protected $guarded = [];

    public function camioneta(){
        return $this->belongsTo(Camioneta::class, 'camioneta_id');
    }

}
