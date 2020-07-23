<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class aluno extends Model
{
    protected $table = 'aluno';   
 
    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }

    public function getCelular1Attribute(){
        return "(".$this->operadora1.") ".$this->cel1;
    }
    
}
