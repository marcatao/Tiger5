<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faula extends Model
{
    protected $table = 'Faula'; 

    public function detalhe(){
        return $this->belongsTo('App\aulas','aula_id','id');
    }  
    public function StatusAula(){
        return $this->belongsTo('App\status','status_id','id');
    }  
    public function Aluno(){
        return $this->belongsTo('App\aluno','aluno_id','id');
    }   
    public function Professor(){
        return $this->belongsTo('App\professor','professor_id','id');
    }   
    public function Maula(){
        return $this->belongsTo('App\Maula','maula_id','id');
    }   
} 
