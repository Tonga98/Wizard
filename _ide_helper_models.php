<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Camioneta
 *
 * @property int $id
 * @property string $patente
 * @property string $ubicacion
 * @property string|null $vtv_vencimiento
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Camioneta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Camioneta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Camioneta query()
 * @method static \Illuminate\Database\Eloquent\Builder|Camioneta whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Camioneta whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Camioneta wherePatente($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Camioneta whereUbicacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Camioneta whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Camioneta whereVtvVencimiento($value)
 */
	class Camioneta extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Chofer
 *
 * @property int $id
 * @property string $nombre
 * @property string $apellido
 * @property int $dni_num
 * @property string|null $email
 * @property string|null $ubicacion
 * @property int|null $num_telefono
 * @property string|null $dni_frente
 * @property string|null $dni_dorso
 * @property string|null $antecedentes_foto
 * @property string|null $antecedentes_venc
 * @property string|null $lic_conducir_venc
 * @property string|null $lic_conducir_frente
 * @property string|null $lic_conducir_dorso
 * @property string|null $linti_venc
 * @property mixed $password
 * @property int $admin
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $id_camioneta
 * @property-read \App\Models\Camioneta $camioneta
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|Chofer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Chofer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Chofer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Chofer whereAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chofer whereAntecedentesFoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chofer whereAntecedentesVenc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chofer whereApellido($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chofer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chofer whereDniDorso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chofer whereDniFrente($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chofer whereDniNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chofer whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chofer whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chofer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chofer whereIdCamioneta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chofer whereLicConducirDorso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chofer whereLicConducirFrente($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chofer whereLicConducirVenc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chofer whereLintiVenc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chofer whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chofer whereNumTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chofer wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chofer whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chofer whereUbicacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chofer whereUpdatedAt($value)
 */
	class Chofer extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Guarda
 *
 * @property int $id
 * @property string $nombre
 * @property string $apellido
 * @property int $dni_num
 * @property string|null $email
 * @property string|null $ubicacion
 * @property int|null $num_telefono
 * @property string|null $dni_frente
 * @property string|null $dni_dorso
 * @property string|null $antecedentes_foto
 * @property string|null $antecedentes_venc
 * @property mixed $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $camioneta_id
 * @property-read \App\Models\Camioneta $camioneta
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|Guarda newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Guarda newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Guarda query()
 * @method static \Illuminate\Database\Eloquent\Builder|Guarda whereAntecedentesFoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guarda whereAntecedentesVenc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guarda whereApellido($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guarda whereCamionetaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guarda whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guarda whereDniDorso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guarda whereDniFrente($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guarda whereDniNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guarda whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guarda whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guarda whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guarda whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guarda whereNumTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guarda wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guarda whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guarda whereUbicacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guarda whereUpdatedAt($value)
 */
	class Guarda extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Pasajero
 *
 * @property int $id
 * @property string $nombre
 * @property string $apellido
 * @property string|null $ubicacion
 * @property int|null $num_telefono
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $camioneta_id
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|Pasajero newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pasajero newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pasajero query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pasajero whereApellido($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pasajero whereCamionetaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pasajero whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pasajero whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pasajero whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pasajero whereNumTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pasajero whereUbicacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pasajero whereUpdatedAt($value)
 */
	class Pasajero extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

