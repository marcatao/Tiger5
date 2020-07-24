<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\planos;
use App\aulas;
use App\aulas_plano;


class PlanosController extends Controller
{
   
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

        ($id == 0 ) ? $plano = new planos : $plano = planos::find($id);
        
        $plano->titulo_plano =$request->titulo_plano;
        $plano->desc_plano =$request->desc_plano;
        $plano->duracao_dias =$request->duracao_dias;
        $plano->valor_plano = (double) $request->valor_plano;
        $plano->academia_id= auth()->user()->academia_id;
        $plano->user_id = auth()->user()->id;
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
}
