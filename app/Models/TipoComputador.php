<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoComputador
 *
 * @property $id
 * @property $tipo_computador
 *
 * @property Ordenador[] $ordenadors
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TipoComputador extends Model
{
    protected $table = 'tipoComputador';
    public $timestamps = false;
    static $rules = [
		'tipo_computador' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['tipo_computador'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ordenadors()
    {
        return $this->hasMany('App\Models\Ordenador', 'id_tipoComputador', 'id');
    }


}
