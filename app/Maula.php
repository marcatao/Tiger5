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
    public function formaPagamento(){
        return $this->belongsTo('App\FormaPagamento','formapagamento_id','id');
    }
    public function statusDesc(){
        return $this->belongsTo('App\status','status_id','id');
    }
    public function QtdAulasEncerradas(){
        return $this->hasMany('App\Faula','maula_id','id')->whereNotIn('status_id',[10]);
    }    
    public function getRenovacaoTextAttribute() {
        $renovacao = "Automática";
        if($this->renovacao == 0) $renovacao="Manual";
        return $renovacao;
    }
    public function aluno(){
        return $this->belongsTo('App\aluno','aluno_id','id');
    } 

    
    
}
