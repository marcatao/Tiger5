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
     public function getAtivo2Attribute() {
        $ativo = false;
        if($this->ativo == 1) $ativo=true;
        return $ativo;
    } 
    public function getAtivoTxtAttribute() {
        $ativo = "inativo";
        if($this->ativo == 1) $ativo="ativo";
        return $ativo;
    }   
}
