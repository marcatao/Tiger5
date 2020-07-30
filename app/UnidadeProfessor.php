<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnidadeProfessor extends Model
{
    protected $table = 'unidade_professor';  

    public function desc(){
        return $this->belongsTo('App\unidades','unidade_id','id');
    }
}
