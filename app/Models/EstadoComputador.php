<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EstadoComputador
 *
 * @property $id
 * @property $estado_computador
 *
 * @property Ordenador[] $ordenadors
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class EstadoComputador extends Model
{
    protected $table = 'estadoComputador';
    public $timestamps = false;
    static $rules = [
		'estado_computador' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['estado_computador'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ordenadors()
    {
        return $this->hasMany('App\Models\Ordenador', 'id_estado', 'id');
    }


}
