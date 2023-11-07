<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tipoaula
 *
 * @property $id
 * @property $descripcion
 * @property $created_at
 * @property $updated_at
 *
 * @property Salon[] $salons
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Tipoaula extends Model
{
    protected $table = 'tipoaula';

    static $rules = [
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['descripcion'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function salons()
    {
        return $this->hasMany('App\Models\Salon', 'tipoaula_id', 'id');
    }


}
