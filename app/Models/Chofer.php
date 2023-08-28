<?php

namespace App\Models;

use Carbon\Carbon;
use GuzzleHttp\Psr7\Query;
use http\QueryString;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Camioneta;
use phpDocumentor\Reflection\Types\Boolean;
use phpDocumentor\Reflection\Types\Collection;
use PhpParser\Node\Expr\Cast\Object_;

class Chofer extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    //Tabla que utiliza el modelo
    protected $table = "choferes";

    //Atributos que no puedo llenar al crear un modelo, to do el resto es fillable
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

    public function camioneta():BelongsTo
    {
        //Este metodo obtiene y retorna la camioneta que maneja el chofer

        return $this->belongsTo(Camioneta::class, 'id_camioneta');
    }

    public static function proximosAVencer() : \Illuminate\Database\Eloquent\Collection
    {
        //Este metodo retorna los choferes que faltan 1 mes o menos para vencer

        //Obtener la fecha del mes próximo
        $mesProximo = Carbon::now()->addMonth();

        $choferes = Chofer::where(function ($query) use ($mesProximo) {
            $query->whereDate('lic_conducir_venc', '<=', $mesProximo)
                ->orWhereDate('antecedentes_venc', '<=', $mesProximo)
                ->orWhereDate('linti_venc', '<=', $mesProximo);
        })->get();

        return $choferes;
    }

    public function camposAVencer(): array
    {
        //Este modulo retorna los campos a vencer del chofer

        //Obtener la fecha del mes próximo
        $mesProximo = Carbon::now()->addMonth();

        //Declaro array
        $campos = [];

        if($this->antecedentes_venc <= $mesProximo){
          $campos['Antecedentes'] = $this->antecedentes_venc;
        }

        if($this->lic_conducir_venc <= $mesProximo){
            $campos['Licencia de conducir'] = $this->lic_conducir_venc;
        }

        if($this->linti_venc <= $mesProximo){
            $campos['Linti'] = $this->linti_venc;
        }
        return $campos;
    }

    public function hasFile():bool{
        //Este metodo verifica si el chofer tiene algun archivo cargado

        //Declaracion de variables
        $hasFile = false;

        if($this->dni_dorso || $this->dni_frente || $this->antecedentes_foto || $this->lic_conducir_frente || $this->lic_conducir_dorso){
            $hasFile = true;
        }
        return $hasFile;
    }

    public static function withFilesLoaded(): \Illuminate\Database\Eloquent\Collection
    {
        /** @var \Illuminate\Database\Eloquent\Collection $choferes */
        //Este metodo retorna todos los choferes que tienen al menos 1 archivo cargado

        $choferes = Chofer::whereNotNull('dni_dorso')
            ->orWhereNotNull('dni_frente')
            ->orWhereNotNull('antecedentes_foto')
            ->orWhereNotNull('lic_conducir_frente')
            ->orWhereNotNull('lic_conducir_dorso')
            ->get();

        return $choferes;
    }

}




