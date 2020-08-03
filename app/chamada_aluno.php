<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chamada_aluno extends Model
{
    protected $table = 'chamada_aluno';  
    
    public function aluno(){
        return $this->belongsTo('App\aluno','aluno_id','id');
    }
    
}
