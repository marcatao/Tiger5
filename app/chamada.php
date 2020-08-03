<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chamada extends Model
{
    protected $table = 'chamada';    

    public function aula(){
        return $this->belongsTo('App\aulas','aula_id','id');
    }
    
    public function professor(){
        return $this->belongsTo('App\professor','professor_id','id');
    }
    
    public function status(){
        return $this->belongsTo('App\status','status_id','id');
    }
    
    public function chamada_aluno(){
        return $this->hasMany('App\chamada_aluno','chamada_id','id');
    }
}
