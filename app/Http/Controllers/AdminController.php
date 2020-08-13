<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\aluno;
use Carbon\Carbon;
use App\Maula;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $dt = Carbon::now();
        $dt = $dt->format('m');


        $alunos = aluno::where('academia_id',auth()->user()->academia_id)->where('ativo','1')->get();
        $aniversariantes = aluno::whereMonth('dt_nacito',$dt)->get();

        $faturas =  Maula::whereIn('status_id',[1,6])
                          ->whereMonth('dt_pagamento',$dt)
                          ->get();


        return view('admin.index')
        ->with('alunos',$alunos)
        ->with('aniversariantes',$aniversariantes)
        ->with('faturas',$faturas); 
    }

}
