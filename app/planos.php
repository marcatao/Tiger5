<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class planos extends Model
{
    protected $table = 'planos';    

    public function aulas(){
        return $this->hasMany('App\aulas_plano','plano_id','id');
    }

}
