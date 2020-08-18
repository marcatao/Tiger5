<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\aluno;
use Carbon\Carbon;
use App\Maula;
use DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $hoje = Carbon::now();
        $dt = $hoje->format('m');


        $alunos = aluno::where('academia_id',auth()->user()->academia_id)
                        ->where('ativo','1')
                        ->get();

        $aniversariantes = DB::select("select id, date((strftime('%Y',date()))||'-'||strftime('%m',date(dt_nacito))||'-'||strftime('%d',date(dt_nacito)))
        from aluno
        where date((strftime('%Y',date()))||'-'||strftime('%m',date(dt_nacito))||'-'||strftime('%d',date(dt_nacito))) >= date()
        order by date((strftime('%Y',date()))||'-'||strftime('%m',date(dt_nacito))||'-'||strftime('%d',date(dt_nacito))) limit 8");

        $faturas =  Maula::whereIn('status_id',[1,6])
                          ->whereMonth('dt_pagamento',$dt)
                          ->get();


        return view('admin.index')
        ->with('alunos',$alunos)
        ->with('aniversariantes',$aniversariantes)
        ->with('faturas',$faturas); 
    }

}
