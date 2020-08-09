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

    

    public static function adiciona(int $aluno_id, int $plano_id, int $formapagamento_id, float $valor_pago, int $user_id, int $status_id, string $dt_pagamento, int $renovacao){
        $plano = planos::find($plano_id);

        $aluno = aluno::find($aluno_id);
        $formapagamento = FormaPagamento::find($formapagamento_id);
        $dt_pagamento = Carbon::createFromFormat('d/m/Y', $dt_pagamento);
        $dt_pagamento = Carbon::parse($dt_pagamento)->format('Y-m-d');
 

 
        $Maula = new Maula();
        $Maula->valor_plano = $plano->valor_plano;
        $Maula->valor_pago =  $valor_pago;
        $Maula->dt_aquisicao = Carbon::now();
        $Maula->dt_pagamento = $dt_pagamento;
        $Maula->aluno_id = $aluno->id;
        $Maula->plano_id = $plano->id;
        $Maula->formapagamento_id= $formapagamento->id;
        $Maula->user_id = $user_id;
        $Maula->status_id = $status_id;
        $Maula->renovacao = $renovacao;
        if($Maula->save()){
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
            }
            $mensagem_historico = "o plano:". $Maula->plano->titulo_plano. " foi adicionado para o cliente";
            $array = ['to_user_id' => $aluno->user_id,'icon' => 'fas fa-boxes bg-blue','mensagem' => $mensagem_historico ];  
            $historico =  HistoricoMovimento::CreateHistorico($array);
        return $Maula;
    
    }
}
