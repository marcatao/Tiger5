<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class professor extends Model
{
    protected $table = 'professor';   

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }
    
}