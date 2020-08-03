<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maula extends Model
{
    protected $table = 'Maula'; 

    public function aulas(){
        return $this->hasMany('App\Faula','maula_id','id');
    }
    public function plano(){
        return $this->belongsTo('App\planos','plano_id','id');
    }
    
    
}
