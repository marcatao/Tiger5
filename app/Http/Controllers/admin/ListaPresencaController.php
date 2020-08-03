<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\chamada;
use App\Admin\ChamadaMovimento;
use App\aulas;
use App\aluno;
use App\chamada_aluno;

class ListaPresencaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
 
    }

    public function index($message=null){
        return view('admin.chamada.index')->with('message',$message);
    }

    public function form_nova_chamada(chamada $chamada=null){
        return view('admin.chamada.forms.nova-chamada')->with('chamada',$chamada);
    }

    public function professor_selection(){
        return view('admin.chamada.lista.professor-select');
    }
    public function aula_selection(){
        return view('admin.chamada.lista.aula-select');
    }

    public function presenca_save(Request $request){
        $chamada = new chamada();
        $chamada->professor_id = $request->professor_id;
        $chamada->aula_id = $request->aula_id;
        $chamada->dt_aula = $request->dt_aula_val;
        $chamada->hora_ini = $request->hora_ini_val;
        $chamada->hora_fim = $request->hora_fim_val;
        $chamada->status_id = 1;
        $chamada->user_id = auth()->user()->id;
        $chamada = ChamadaMovimento::CriarChamada($chamada);
        return $this->index($chamada);
    }

    public function lista_presenca(Request $request){
        
        if($request->param1 == '1') $array = ['1'];
        if($request->param1 == '0') $array = ['4','3'];
        $chamadas = chamada::whereIn('status_id',$array)->get();
        return view('admin.chamada.lista.chamadas')->with('chamadas',$chamadas);
    }

    public function lista_presenca_alunos(Request $request){
        $chamada_id = $request->param1;
        $chamada = chamada::find($chamada_id);
        $aula = aulas::find($chamada->aula_id);
        $alunos = ChamadaMovimento::AlunosComCredito($aula,$chamada);
        return view('admin.chamada.lista.alunos')
        ->with('chamada',$chamada)
        ->with('alunos',$alunos);
    }

    public function chamada_aluno(Request $request){
        $chamada_id = $request->param1;
        $aluno_id = $request->param2;
        $chamada = chamada::find($chamada_id);
        $aluno = aluno::find($aluno_id);
        return ChamadaMovimento::IncluirAlunoChamada($chamada,$aluno);
    }
    public function chamada_aluno_del(Request $request){
        $chamada_aluno_id = $request->param1;
        $chamada_aluno = chamada_aluno::find($chamada_aluno_id);
        return ChamadaMovimento::ExcluirAlunoChamada($chamada_aluno);
    }

    public function altera_status(Request $request){
        $chamada_id = $request->param1;
        $status_id = $request->param2;
        $chamada = chamada::find($chamada_id);
        return ChamadaMovimento::AlteraStatusChamada($chamada,$status_id);
    }
}
