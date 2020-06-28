<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class aulas extends Model
{
    protected $table = 'aulas';    
    protected $fillable = ['desc'];

    public function academia(){
        return $this->belongsTo('App\academias','academia_id','id');
    }
    
}
