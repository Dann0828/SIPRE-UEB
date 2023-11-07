<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoRam
 *
 * @property $id
 * @property $tipoRam
 *
 * @property Ordenador[] $ordenadors
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TipoRam extends Model
{
    protected $table = 'tipoRam';
    public $timestamps = false;
    static $rules = [
		'tipoRam' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['tipoRam'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ordenadors()
    {
        return $this->hasMany('App\Models\Ordenador', 'id_modeloRam', 'id');
    }


}