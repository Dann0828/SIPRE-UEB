<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoAsignacionLocalidad
 *
 * @property $id
 * @property $tipoAsignacion
 *
 * @property Ordenador[] $ordenadors
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TipoAsignacionLocalidad extends Model
{
    protected $table = 'tipoAsignacionLocalidad';
    public $timestamps = false;
    static $rules = [
		'tipoAsignacion' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['tipoAsignacion'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ordenadors()
    {
        return $this->hasMany('App\Models\Ordenador', 'id_tipoAsignacion', 'id');
    }


}
