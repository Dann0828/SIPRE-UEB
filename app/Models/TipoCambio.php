<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tipocambio
 *
 * @property $id
 * @property $descripcion
 * @property $created_at
 * @property $updated_at
 *
 * @property MantenimientoOrdenador[] $mantenimientoOrdenadors
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Tipocambio extends Model
{
    protected $table = 'tipoCambio';
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
    public function mantenimientoOrdenadors()
    {
        return $this->hasMany('App\Models\MantenimientoOrdenador', 'id_tipocambio', 'id');
    }


}
