<?php

namespace App\Http\Controllers\admin\relatorios;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\aluno;

class AniversariosController extends Controller
{
    public function aniversarios(){

        return view('admin.relatorios.aniversarios.form');
    }

    public function aniversarios_dados(Request $request){
        $mes = $request->param1['mes'];
        $alunos = aluno::whereMonth('dt_nacito',$mes)->orderBy('dt_nascito')->get();
        return view('admin.relatorios.aniversarios.dados')->with('alunos',$alunos)->with('mes',$mes);
    }
}
