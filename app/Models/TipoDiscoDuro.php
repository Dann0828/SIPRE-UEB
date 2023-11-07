<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoDiscoDuro
 *
 * @property $id
 * @property $tipoDiscoDuro
 *
 * @property Ordenador[] $ordenadors
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TipoDiscoDuro extends Model
{
    protected $table = 'tipoDiscoDuro';
    public $timestamps = false;
    static $rules = [
		'tipoDiscoDuro' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['tipoDiscoDuro'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ordenadors()
    {
        return $this->hasMany('App\Models\Ordenador', 'id_tipo_dicoDuro', 'id');
    }


}