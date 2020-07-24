<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class aulas_plano extends Model
{
    protected $table = 'aulas_plano';    


    public function aula(){
        return $this->belongsTo('App\aulas','aula_id','id');
    }
}
