<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tipoaux
 *
 * @property $id
 * @property $tipo_aux
 * @property $created_at
 * @property $updated_at
 *
 * @property Perifericosyauxiliare[] $perifericosyauxiliares
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Tipoaux extends Model
{
    protected $table = 'tipoaux';
    public $timestamps = false;
    static $rules = [
		'tipo_aux' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['tipo_aux'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function perifericosyauxiliares()
    {
        return $this->hasMany('App\Models\Perifericosyauxiliare', 'id_tipoaux', 'id');
    }


}