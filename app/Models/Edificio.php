<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Edificio
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
class Edificio extends Model
{
    protected $table = 'edificio';

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
        return $this->hasMany('App\Models\Salon', 'edificio_id', 'id');
    }


}
