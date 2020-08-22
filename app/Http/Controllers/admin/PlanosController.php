<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\planos;
use App\aulas;
use App\aulas_plano;
use App\Admin\PlanoMovimento;

use App\Maula;
use App\Faula;


class PlanosController extends Controller
{
   

    public function __construct()
     {
        $this->middleware('auth');
     }


    public function index(){
        $p = planos::where('academia_id',auth()->user()->academia_id)->get();
        return view('admin.planos.lista')->with('planos',$p);
    }

    public function form($id,$message=null){
        $plano = null;
        if(!$id == 0 ) $plano = planos::find($id);
        return view('admin.planos.form')
                    ->with('id',$id)
                    ->with('plano',$plano)
                    ->with('message',$message);
    }

    public function form_save($id, Request $request){
        $request->validate([
            'titulo_plano' => 'required|max:255|min:5',
            'desc_plano' => 'required|max:255|min:5',
            'duracao_dias' => 'required|integer',
            'valor_plano' => 'required|between:0,99.99',
            ]);
        
        $visivel_site = 0;
        $visivel_valor =0;
        if($request->visivel_site)  $visivel_site = 1;
        if($request->visivel_valor) $visivel_valor = 1;

        ($id == 0 ) ? $plano = new planos : $plano = planos::find($id);
        
        $plano->titulo_plano =$request->titulo_plano;
        $plano->desc_plano =$request->desc_plano;
        $plano->duracao_dias =$request->duracao_dias;
        $plano->valor_plano = (double) $request->valor_plano;
        $plano->academia_id= auth()->user()->academia_id;
        $plano->user_id = auth()->user()->id;
        $plano->visivel_site = $visivel_site;
        $plano->visivel_valor = $visivel_valor;
        if($plano->save()){
            $id=$plano->id;
            $message = ['type'=>'success','message'=>' Dados alterados !'];
            return $this->form($id,$message);
        }

        
        dd($request->titulo_plano);   
    } 

    public function delete_plano($id){
        $plano = planos::find($id);
        if($plano->delete()){
            return response('deleted',206);
        }
    }




 

    //aulas_plano
    public function aulas_plano(Request $request){
        $plano_id = $request->param1;
        $aulas = aulas::where('academia_id',auth()->user()->academia_id)->get();
        return view('admin.planos.aulas_plano')->with('aulas',$aulas)->with('plano_id',$plano_id);
    }

    public function aulas_plano_store(Request $request){
        $a = new aulas_plano;
        $a->plano_id = $request->plano_id;
        $a->aula_id = $request->aula_id;
        $a->qtd_aulas = $request->qtd_aulas;
        $a->save();
        $message = ['type'=>'success','message'=>' Dados alterados !'];
        return $this->form($a->plano_id,$message);
     
    }

    public function delete_aula_do_plano($id){
        $a = aulas_plano::find($id);
        $plano_id = $a->plano_id;
        $a->delete();
        $message = ['type'=>'success','message'=>' Aula deletada !'];
        return $this->form($plano_id,$message);

    }



    public function aluno_plano($id){
        return view('admin.planos.plano-aluno')->with('id',$id);
    }

    public function form_plano_manual(Request $request){
        $plano_id = $request->param1;
        $aluno_id = $request->param2;
        $Maula = Maula::find($plano_id);
        return view('admin.planos.planos.plano-manual')
        ->with('Maula',$Maula)
        ->with('id',$aluno_id);
    }

    public function post_plano(Request $request){
        
        //deleta 
        if($request->param3 == 'deleta'){
            $maula_id = $request->param2;
            $Maula = Maula::find($maula_id);
            if($Maula){
                return PlanoMovimento::deleta($Maula);
            }
        }

        $aluno_id = (int) $request->param1['aluno_id'];
        $plano_id = (int) $request->param1['plano_id'];
        $formapagamento_id = (int) $request->param1['formapagamento_id'];
        $valor_pago = (float) $request->param1['valor_pago'];
        $dt_pagamento = $request->param1['dt_pagamento'];
        $renovacao = $request->param1['renovacao'];
        $user_id = auth()->user()->id;
        $status_id = 1;

        //EDICAOOOOOOO
        if($request->param2){
            $maula_id = $request->param2;
            $Maula = Maula::find($maula_id);
            if($Maula){
                $Maula->plano_id= $plano_id;
                $Maula->formapagamento_id = $formapagamento_id;
                $Maula->valor_pago =$valor_pago;
                $Maula->dt_pagamento = $dt_pagamento;
                $Maula->renovacao = $renovacao;
                $Maula->user_id = $user_id;
                $Maula->status_id= $request->param1['status_id'];
                return PlanoMovimento::edita($Maula);
            }//if Maula existe 
        }//if parametro existe
        

        return PlanoMovimento::adiciona($aluno_id,$plano_id,$formapagamento_id,$valor_pago,$user_id,$status_id,$dt_pagamento,$renovacao);
    }

//////////////////////////////////////////////////////////////////////////////////////////////////
    public function lista_aulas_aluno($id, Request $request){
        $aluno_id = $id;
        $status_id = $request->param1;
        $status = ['10','9'];
        if($status_id  == 0 ) $status = ['7'];

        $Faula = Faula::where('aluno_id',$aluno_id)
                      ->whereIn('status_id',$status)
                      ->get();


        return  view('admin.planos.planos.tabela-plano')
                     ->with('Faulas',$Faula)
                     ->with('id',$id);
    }
/////////////////////////////////////////////////////////////////////////////
    public function lista_planos_aluno($id){

        $maula = Maula::where('aluno_id',$id)
                ->whereIn('status_id',[1,6])
                ->orderBy('updated_at','desc')->take(15)->get();
        return view('admin.planos.planos.maula-aluno')
        ->with('Maulas',$maula);
    }



    public function adicionar_pagamento(Request $request){
        $Maula = Maula::find($request->param1);
        return view('admin.planos.planos.pagamentos.pagamento-form')
        ->with('Maula',$Maula);
    }

    public function salvar_pagamento(Request $request){
        $maula_id = (int) $request->param1['maula_id'];
        $Maula = Maula::find($maula_id);
        $valor_pago = (float) $request->param1['valor_pago'];
        $formapagamento_id = (int) $request->param1['formapagamento_id'];
        PlanoMovimento::pagar($Maula,$formapagamento_id,$valor_pago,auth()->user()->id);

        return "Pagamento realizado com sucesso";
    }    










}
