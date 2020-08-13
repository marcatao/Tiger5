<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Maula;
use Carbon\Carbon;
use App\Admin\PlanoMovimento;
use DB;
use App\Mail\AjustePlanosDiario;
use Illuminate\Support\Facades\Mail;

class CheckController extends Controller
{
    public function index(){

        //select * from Maula
        //where renovacao = 1 AND
        //cast(strftime('%m',dt_pagamento) as integer) < cast(strftime('%m',date('now')) as integer)
        
        //$dt = Carbon::now();
        //$dt->addMonths(-1);
        //$planos_renocao = Maula::where('renovacao',1)
        //                 ->where('dt_pagamento','<=', $dt) ->get();
        echo "<h2>Renovando os planos mensais</h2>";
        $dt = Carbon::now();
        $dt = $dt->format('m');
        $planos_renocao = Maula::where('renovacao',1)
                               ->where('status_id',1)
                               ->whereMonth('dt_pagamento','<', $dt)
                               ->whereNull('sub')
                               ->get();
        foreach ($planos_renocao as $plano){
            try{
             ;
                DB::beginTransaction(); 
                $dt_pagamento =  Carbon::createFromFormat('Y-m-d', $plano->dt_pagamento);
                $dt_pagamento->addMonths(1);
                $dt_pagamento = $dt_pagamento->format('Y-m-d');
          
                $aluno_id = $plano->aluno_id;
                $plano_id = $plano->plano_id;
                echo "plano_id:".$plano_id;
                $formapagamento_id= 0;
                $valor_pago = 0;
                $user_id = 1;
                $renovacao = 1;
                $status_id =1;
                //echo "data pagamento".$plano->dt_pagamento;  
                $Maula = PlanoMovimento::adiciona($aluno_id,$plano_id,$formapagamento_id,$valor_pago,$user_id,$status_id,$dt_pagamento,$renovacao,true);
                $plano->sub = $Maula->id;
                $plano->status_id = 4;
                $plano->save();
                DB::commit();
                echo "<p>Renovado o plano numero:".$Maula->id."</p>";
         
            } catch(\Exception $e){
                //if there is an error/exception in the above code before commit, it'll rollback
                 DB::rollBack();
                 return $e->getMessage();
                 
            }

        }
        

        $dt = Carbon::now();
        $dt = $dt->format('Y-m-d');
        echo"<h2>Verificando planos vencidos</h2>";
        $planos_renocao = Maula::where('renovacao',1)
                               ->where('status_id',1)
                               ->where('dt_pagamento','<', $dt)
                               ->where('valor_pago',0)
                               ->get();

                               foreach ($planos_renocao as $plano){
                                try{
                                   
                                    DB::beginTransaction();
                                    $ret = PlanoMovimento::atrasado($plano);
                                    DB::commit();
                                    echo "<p>Marcando como vencido:".$plano->id."</p>";
                             
                                } catch(\Exception $e){
                                    //if there is an error/exception in the above code before commit, it'll rollback
                                     DB::rollBack();
                                     return $e->getMessage();
                                }
                    
                            }
                               //Mail::to('thiagomarcato@gmail.com')->send(new AjustePlanosDiario());                               
         
        return $planos_renocao;
    }
}
