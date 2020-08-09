<?php

namespace App\Admin;

use Carbon\Carbon;
use App\historico;
 
class HistoricoMovimento
{
   
    public static function CreateHistorico(Array $array){
        $historico = new historico();
        $historico->to_user_id = $array['to_user_id'];
        $historico->dt_ocorrencia = now();
        $historico->icon = $array['icon'];
        $historico->mensagem = $array['mensagem'];
        $historico->user_id = auth()->user()->id;
        return $historico->save();

    }

}
