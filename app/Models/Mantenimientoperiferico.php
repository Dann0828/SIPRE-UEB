<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Mantenimientoperiferico
 *
 * @property $id
 * @property $perifericos_id
 * @property $users_id
 * @property $id_tipo_mantenimiento
 * @property $descripcion
 * @property $fecha
 * @property $created_at
 * @property $updated_at
 *
 * @property Hojavidaperiferico[] $hojavidaperifericos
 * @property Hojavidaperiferico[] $hojavidaperifericos
 * @property Perifericosyauxiliare $perifericosyauxiliare
 * @property TipoMantenimiento $tipomantenimiento
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Mantenimientoperiferico extends Model
{
    protected $table = 'mantenimientoperiferico';
    static $rules = [
		'perifericos_id' => 'required',
		'users_id' => 'required',
		'id_tipo_mantenimiento' => 'required',
		'descripcion' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['perifericos_id','users_id','id_tipo_mantenimiento','descripcion','fecha'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function perifericosyauxiliare()
    {
        return $this->hasOne('App\Models\Perifericosyauxiliare', 'id', 'perifericos_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tipomantenimiento()
    {
        return $this->hasOne('App\Models\TipoMantenimiento', 'id', 'id_tipo_mantenimiento');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'users_id');
    }

}