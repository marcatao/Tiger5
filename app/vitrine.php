<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vitrine extends Model
{
    protected $table = 'vitrine'; 

    public function getStatusAttribute() {
        if($this->ativo == 1) return "Ativo";
        return "Inativo";
    }  

    public function imagens(){
        return $this->hasMany('App\vitrine_img','vitrine_id','id');
    }
}
