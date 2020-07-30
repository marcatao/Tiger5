<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class professor extends Model
{
    protected $table = 'professor';   

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }
    
    public function getFotoPerfilAttribute() {
        if($this->foto) return $this->foto;
        return '/admin/profiles/nofoto.png';
    }  

    public function unidades(){
        return $this->hasMany('App\UnidadeProfessor','professor_id','id');
    }

    
}
