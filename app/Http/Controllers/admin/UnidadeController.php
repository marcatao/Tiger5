<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\unidades;

class UnidadeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }



    public function index($message=null){
        $unidades = unidades::where('academia_id',auth()->user()->academia_id)->get();
        return view('admin.unidades.lista')
        ->with('unidades',$unidades)
        ->with('message',$message);
    }

    public function form($id,$message=null){
        $unidade = unidades::find($id);
        return view ('admin.unidades.form')
        ->with('id',$id)
        ->with('message',$message)
        ->with('unidade',$unidade);
    }

    public function save($id, Request $request){
        $unidade = unidades::find($id);
        if(!$unidade) $unidade = new unidades();
        $unidade->titulo = $request->titulo;
        $unidade->sub_titulo = $request->sub_titulo;
        $unidade->end1 = $request->end1;
        $unidade->end2 = $request->end2;
        $unidade->end3 = $request->end3;
        $unidade->whats = $request->whats;
        $unidade->responsavel = $request->responsavel;
        $unidade->insta = $request->insta;
        $unidade->academia_id= auth()->user()->academia_id;
        if($unidade->save()){
            $message = ['type'=>'success','message'=>' Dados alterados !'];
        }
        return $this->form($unidade->id,$message);
    }

    public function delete($id){
        $unidade = unidades::find($id);
        if($unidade->delete()){
            $message = ['type'=>'success','message'=>'Unidade excluida com sucesso !'];
        }
        return $this->index($message);
    }
}
