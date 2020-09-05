<?php

namespace App\Http\Controllers\admin\relatorios;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\aluno;
use Carbon\Carbon;

class AniversariosController extends Controller
{
    public function aniversarios(){

        return view('admin.relatorios.aniversarios.form');
    }

    public function aniversarios_dados(Request $request){
        $mes = $request->param1['mes'];
        $alunos = aluno::whereMonth('dt_nacito',$mes)->orderBy('dt_nacito')->get()
        ->groupBy(function ($val) {
            return (int) Carbon::parse($val->dt_nacito)->format('d');
        });
        
        return view('admin.relatorios.aniversarios.dados')->with('alunos',$alunos)->with('mes',$mes);
    }
}
