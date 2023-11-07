<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Dependenciaua
 *
 * @property $id
 * @property $dependencia
 * @property $areaua_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Tipoareaua $tipoareaua
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Dependenciaua extends Model
{
    protected $table = 'dependenciaua';
    public $timestamps = false;
    static $rules = [
		'areaua_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['dependencia','areaua_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tipoareaua()
    {
        return $this->hasOne(Tipoareaua::class, 'id', 'areaua_id');
    }
    
    public function prestamos()
    {
        return $this->belongsToMany(Prestamo::class, 'prestamo_dependencia', 'prestamo_id', 'dependenciaua_id');
    }

    public function prestamops()
    {
        return $this->belongsToMany(Prestamop::class, 'prestamop_dependencia', 'prestamop_id', 'dependenciaua_id');
    }

}
