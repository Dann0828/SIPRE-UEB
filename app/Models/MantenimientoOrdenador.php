<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MantenimientoOrdenador
 *
 * @property $id
 * @property $ordenador_id
 * @property $users_id
 * @property $id_tipo_mantenimiento
 * @property $id_tipocambio
 * @property $descripcion
 * @property $fecha
 * @property $created_at
 * @property $updated_at
 *
 * @property Hojavidaordenador[] $hojavidaordenadors
 * @property Hojavidaordenador[] $hojavidaordenadors
 * @property Ordenador $ordenador
 * @property TipoCambio $tipocambio
 * @property TipoMantenimiento $tipomantenimiento
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class MantenimientoOrdenador extends Model
{
    protected $table = 'mantenimiento_ordenador';
    static $rules = [
		'users_id' => 'required',
		'id_tipo_mantenimiento' => 'required',
		'id_tipocambio' => '',
		'descripcion' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['ordenador_id','users_id','id_tipo_mantenimiento','id_tipocambio','salon_id','descripcion','fecha'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ordenador()
    {
        return $this->hasOne('App\Models\Ordenador', 'id', 'ordenador_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function salonOrdenador()
    {
        return $this->hasOne('App\Models\SalonOrdenador', 'id', 'salon_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tipocambio()
    {
        return $this->hasOne('App\Models\TipoCambio', 'id', 'id_tipocambio');
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