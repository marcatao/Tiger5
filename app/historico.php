<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class historico extends Model
{
    protected $table = 'historico'; 

    public function responsavel(){
        return $this->belongsTo('App\user','user_id','id');
    }

    public function getOcorrenciaDataAttribute(){
        $dt = Carbon::createFromFormat('Y-m-d H:i:s', $this->dt_ocorrencia);
        return $dt->format('d/m/Y');
    }
    public function getOcorrenciaHoraAttribute(){
        $dt = Carbon::createFromFormat('Y-m-d H:i:s', $this->dt_ocorrencia);
        return $dt->format('H:i');
    }
}
