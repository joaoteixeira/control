<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Key extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'keys';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['copia', 'disponivel', 'room_id'];

    public function room()
    {
        return $this->belongsTo('App\Room');
    }

    public function people() {
        return $this->belongsToMany('App\Person', 'keys_has_people', 'key_id','people_id')
            ->withPivot('retirada', 'devolucao', 'id');
    }

}
