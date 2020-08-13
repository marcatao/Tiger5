<?php

namespace App\Admin;

use Carbon\Carbon;

use App\planos;
use App\aluno;
use App\FormaPagamento;
use App\aulas_plano;

use App\Maula;
use App\Faula;
use App\Admin\HistoricoMovimento;

class PlanoMovimento
{

    public static function deleta(Maula $Maula){
        
        $deleted = Faula::where('maula_id',$Maula->id)->delete();
        $mensagem_historico = "o plano:". $Maula->plano->titulo_plano. " foi deletado pelo administrador";
        $array = ['to_user_id' => $Maula->aluno->user_id,'icon' => 'fas fa-boxes bg-blue','mensagem' => $mensagem_historico ];  
        $historico =  HistoricoMovimento::CreateHistorico($array);
        $Maula->delete();
        return "deletado";

    }
    public static function edita(Maula $Maula){
        $dt_pagamento = $Maula->dt_pagamento;
        //data em ingles
        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$dt_pagamento))
            $dt_pagamento = Carbon::createFromFormat('Y-m-d', $dt_pagamento);
        //data em br
        if (preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/[0-9]{4}$/",$dt_pagamento))
            $dt_pagamento = Carbon::createFromFormat('d/m/Y', $dt_pagamento);
        $dt_pagamento = Carbon::parse($dt_pagamento)->format('Y-m-d');

        $Maula->dt_pagamento = $dt_pagamento;
        if($Maula->renovacao == 1){
            $deleted = Faula::where('maula_id',$Maula->id)->delete();
        }
        $Maula->save();
        $mensagem_historico = "o plano:". $Maula->plano->titulo_plano. " foi alterado algumas informações";
        $array = ['to_user_id' => $Maula->aluno->user_id,'icon' => 'fas fa-boxes bg-blue','mensagem' => $mensagem_historico ];  
        $historico =  HistoricoMovimento::CreateHistorico($array);
        return $Maula;

    }

    public static function adiciona(int $aluno_id, int $plano_id, int $formapagamento_id, float $valor_pago, int $user_id, int $status_id, string $dt_pagamento, int $renovacao, bool $novo=null){
        $plano = planos::find($plano_id);

        $aluno = aluno::find($aluno_id);
        $formapagamento = FormaPagamento::find($formapagamento_id);

        //data em ingles
        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$dt_pagamento))
            $dt_pagamento = Carbon::createFromFormat('Y-m-d', $dt_pagamento);
        //data em br
        if (preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/[0-9]{4}$/",$dt_pagamento))
            $dt_pagamento = Carbon::createFromFormat('d/m/Y', $dt_pagamento);
        
        $dt_pagamento = Carbon::parse($dt_pagamento)->format('Y-m-d');
  
        $Maula = new Maula();
        $Maula->valor_plano = $plano->valor_plano;
        $Maula->valor_pago =  $valor_pago;
        $Maula->dt_aquisicao = Carbon::now();
        $Maula->dt_pagamento = $dt_pagamento;
        $Maula->aluno_id = $aluno->id;
        $Maula->plano_id = $plano->id;
        $Maula->formapagamento_id= $formapagamento_id;
        $Maula->user_id = $user_id;
        $Maula->status_id = $status_id;
        $Maula->renovacao = $renovacao;
        if($Maula->save()){
           if($Maula->renovacao == 0){ 
            $aulasDoPlano = aulas_plano::where('plano_id',$plano->id)->get();
            foreach ($aulasDoPlano as $key => $aula) {
                 for ($i=0; $i < $aula->qtd_aulas; $i++) { 
                     $Faula = new Faula();
                     $Faula->aluno_id = $aluno->id;
                     $Faula->aula_id = $aula->aula_id;
                     $Faula->professor_id = null;
                     $Faula->maula_id = $Maula->id;
                     $Faula->dt_inicio = $dt_pagamento;
                     $dt_fim = Carbon::createFromFormat('Y-m-d', $Faula->dt_inicio);
                     $Faula->dt_fim = $dt_fim->add("$plano->duracao_dias day");
                     $Faula->dt_utilizacao = null;
                     $Faula->status_id = 10;
                     $Faula->save();
                       
                     } 
                 }
              } //IF existe aulas agendadas...  
            }
            $mensagem_historico = "o plano:". $Maula->plano->titulo_plano. " foi adicionado para o cliente";
            if($novo) $mensagem_historico =   "o plano:". $Maula->plano->titulo_plano. " foi renovado automáticamente pelo sistema";
            $array = ['to_user_id' => $aluno->user_id,'icon' => 'fas fa-boxes bg-blue','mensagem' => $mensagem_historico ];  
            $historico =  HistoricoMovimento::CreateHistorico($array);
        return $Maula;
    
    }

    public static function atrasado(Maula $maula){
        $maula->status_id = 6;
        return $maula->save();
    }

    public static function pagar(Maula $Maula, int $formapagamento_id,float $valor_pago, int $user_id){
        
        $Maula->valor_pago = $valor_pago;
        $Maula->status_id = 1;
        $Maula->formapagamento_id = 1;
        $Maula->user_id = $user_id;
        if($Maula->save()){
            $array = ['to_user_id' => $user_id,'icon' => 'fas fa-boxes bg-blue','mensagem' => 'Adicionado pagamento de '.$valor_pago.' no plano '.$Maula->plano->titulo_plano ];  
            $historico =  HistoricoMovimento::CreateHistorico($array);
        }
        return true;
    }
}
