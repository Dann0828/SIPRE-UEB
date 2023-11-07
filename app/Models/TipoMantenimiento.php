<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tipomantenimiento
 *
 * @property $id
 * @property $descripcion
 * @property $created_at
 * @property $updated_at
 *
 * @property Mantenimientoperiferico[] $mantenimientoperifericos
 * @property MantenimientoOrdenador[] $mantenimientoOrdenadors
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Tipomantenimiento extends Model
{
    protected $table = 'tipoMantenimiento';

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
    public function mantenimientoperifericos()
    {
        return $this->hasMany('App\Models\Mantenimientoperiferico', 'id_tipo_mantenimiento', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mantenimientoOrdenadors()
    {
        return $this->hasMany('App\Models\MantenimientoOrdenador', 'id_tipo_mantenimiento', 'id');
    }


}
