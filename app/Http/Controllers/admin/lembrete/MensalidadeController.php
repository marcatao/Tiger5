<?php

namespace App\Http\Controllers\admin\lembrete;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Maula;
use App\aluno;

use App\Mail\VencimentoEmail;
use Illuminate\Support\Facades\Mail;


class MensalidadeController extends Controller
{
    public function index(){
        $dt = Carbon::now();
        $dt->addDays(5);
        $dt = $dt->format('Y-m-d');

        $Maulas = Maula::where('dt_pagamento',$dt)
                        ->where('valor_pago','0')
                        ->where('sub',null)
                        ->whereIn('status_id',[1,6])
                        ->get();
       
        foreach($Maulas as $planos){
            $vencimento = Carbon::createFromFormat("Y-m-d", $planos->dt_pagamento);
            $vencimento->addMonth(1);
            $aluno =  aluno::find($planos->aluno_id);
            
            $dados = ['valor_plano'=>$planos->valor_plano,
                      'plano' => $planos->plano->titulo_plano,
                      'vencimento' => $vencimento->format('d/m/Y'),
                       'nome'=> $aluno->nome];
            $email_to = $aluno->email;

            Mail::to([['email' => 'contato@tigerthai.com.br', 'name'=> 'lael']])
                      ->send(new VencimentoEmail($dados));
 
             
        }


        return $dt;
    }
}
