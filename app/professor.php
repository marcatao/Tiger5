<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon;

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
    public function aulas(){
        return $this->hasMany('App\aulas_professor','professor_id','id');
    }

    public function getDtNascitoBrAttribute() {
        $aniversario = $this->dt_nacito;
        //data em ingles
        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$aniversario))
            $aniversario = Carbon\Carbon::createFromFormat('Y-m-d', $aniversario);
       
        //data em br
        if (preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/[0-9]{4}$/",$aniversario))
            $aniversario = Carbon\Carbon::createFromFormat('d/m/Y', $aniversario);
         
        return $aniversario->format('d/m/Y');
    }  
}
