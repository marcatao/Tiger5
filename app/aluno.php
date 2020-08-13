<?php

namespace App;
use App\Maula;
use  DB;
use Illuminate\Database\Eloquent\Model;

class aluno extends Model
{
    protected $table = 'aluno';   
    public $timestamps = true;
    
    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }
    public function Planos(){
        return $this->hasMany('App\Maula','aluno_id','id');
    }
    public function planosDoAluno() {
       return $this->hasMany('App\Maula','aluno_id','id');
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
    public function getFotoPerfilAttribute() {
        if($this->foto) return $this->foto;
        return '/admin/profiles/nofoto.png';
    }  
    
    public function ListaModalidatesAtivas(){
        $sub_menu_lateral = DB::select('select D.desc, A.dt_pagamento, A.status_id
        from Maula A
        join planos B on A.plano_id = B.id
        join aulas_plano C on C.plano_id = B.id
        join aulas D on C.aula_id = D.id
        where A.aluno_id = '.$this->id.' and A.status_id in (1,6)');
        return $sub_menu_lateral;
    }
}
