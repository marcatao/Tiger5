<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\aluno;
use App\User;
use App\Admin\LoginCreate;

class AlunoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }


    public function index($message=null){
        $alunos = aluno::where('academia_id',auth()->user()->academia_id)->get();
        return view('admin.alunos.lista')
        ->with('alunos',$alunos)
        ->with('message',$message);

    }

    public function edita($id){
        $aluno = aluno::where('id',$id)->where('academia_id',auth()->user()->academia_id)->first();
        return $this->aluno_registra($aluno);
    }
    public function aluno_registra($aluno=null){
        return view('admin.alunos.form')->with('aluno',$aluno);
    }

    public function store_aluno_registra(Request $request){
        $ativo = 0;
        if($request->ativo) $ativo=1;
        $aluno = aluno::where('cpf',$request->cpf)->first();
        if(!$aluno) $aluno = new aluno;
                 $aluno->ativo         =$ativo;
                 $aluno->user_id       =$request->user_id    ;
                 $aluno->cpf           =$request->cpf        ;
                 $aluno->rg            =$request->rg         ;
                 $aluno->nome          =$request->nome       ;
                 $aluno->sexo          =$request->sexo       ;
                 $aluno->dt_nacito     =$request->dt_nacito  ;
                 $aluno->tel           =$request->tel        ;
                 $aluno->cel1          =$request->cel1       ;
                 $aluno->operadora1    =$request->operadora1 ;
                 $aluno->cel2          =$request->cel2       ;
                 $aluno->operadora2    =$request->operadora2 ;
                 $aluno->email         =$request->email      ;  
                 $aluno->cep           =$request->cep        ;
                 $aluno->rua           =$request->rua        ;
                 $aluno->numero        =$request->numero     ;
                 $aluno->bairro        =$request->bairro     ;
                 $aluno->cidade        =$request->cidade     ;
                 $aluno->estado        =$request->estado     ;
                 $aluno->complemento   =$request->complemento;   
                 $aluno->academia_id   =auth()->user()->academia_id;
                 
                 

                 $message="777";
                 if($aluno->save()){
                      $senha = preg_replace('/[^0-9]/', '', $request->dt_nacito);
                      $user = User::where('email',$aluno->email)->first();
                      if(!$user){
                      $user = LoginCreate::CriarLogin($aluno->nome,
                                              $aluno->email,
                                              $senha,
                                              auth()->user()->academia_id,
                                              1);
                        $aluno->user_id=$user->id;
                        $aluno->save();                                             
                      }
                      
                      $message = ['type'=>'success','message'=>' Dados alterados !'];

                 }
        
        return $this->index($message);


    }
}
