<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'people';

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
    protected $fillable = ['tipo', 'nome', 'cpf', 'siape', 'email', 'campi_id'];

    public function campi()
    {
        return $this->belongsTo('App\Campi');
    }

    public function keys() {
        return $this->belongsToMany('App\Key', 'keys_has_people', 'people_id', 'key_id')
            ->withPivot('retirada', 'devolucao', 'id');
    }
}
