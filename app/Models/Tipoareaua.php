<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tipoareaua
 *
 * @property $id
 * @property $descripcion
 * @property $created_at
 * @property $updated_at
 *
 * @property Dependenciaua[] $dependenciauas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Tipoareaua extends Model
{
    protected $table = 'tipoareaua';
    public $timestamps = false;

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
    public function dependenciauas()
    {
        return $this->hasMany('App\Models\Dependenciaua', 'areaua_id', 'id');
    }
    

}
