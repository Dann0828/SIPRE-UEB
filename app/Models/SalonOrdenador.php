<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SalonOrdenador
 *
 * @property $salon_id
 * @property $ordenador_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Ordenador $ordenador
 * @property Salon $salon
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class SalonOrdenador extends Model
{
    protected $table = 'salonOrdenador';
    static $rules = [
		'salon_id' => 'required',
		'ordenador_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['salon_id','ordenador_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ordenador()
    {
        return $this->hasOne('App\Models\Ordenador', 'id', 'ordenador_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function salon()
    {
        return $this->hasOne('App\Models\Salon', 'id', 'salon_id');
    }
    

}
