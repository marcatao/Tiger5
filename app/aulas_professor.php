<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class aulas_professor extends Model
{
    protected $table = 'aulas_professor';    


    public function aula(){
        return $this->belongsTo('App\aulas','aula_id','id');
    }
    public function professor(){
        return $this->belongsTo('App\professor','professor_id','id');
    }
}
