<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\aulas;
use App\GradeAula;
use App\professor;
use App\aula_detalhe;
use App\unidades;

class aulasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
 
    }
    public function index(){
        $aulas = aulas::where('academia_id',auth()->user()->academia_id)->get();
        return view('admin.aulas.listagem')
        ->with('aulas',$aulas);
    }
    public function form_aulas($id){
        $aula="";
        if($id > 0) $aula = aulas::find($id);
        return view('admin.aulas.form')
                 ->with('id',$id)
                 ->with('aula',$aula);
    }

    public function create_aulas(Request $request){
        $a = aulas::find($request->id);
        if(!$a) $a = new aulas;
        $a->desc = $request->desc;
        $a->academia_id = auth()->user()->academia_id;
        $a->profile_id = auth()->user()->id;
        $a->resumo = $request->resumo;
        $a->link = mb_strtolower(str_replace(' ','-', $request->desc));
        if($a->save()){
            return redirect(route('cadastro-aula'));
        }
    }

    public function delete_aulas($id){
        $aula = aulas::find($id);
        if($aula->delete()){
            return redirect(route('cadastro-aula'));
        }
    }


    public function detalhe_aula($id){
        $detalhe = aula_detalhe::where('aula_id',$id)->first();
        $aula = aulas::find($id);
        if(!$detalhe){
            $detalhe = new aula_detalhe;
            $detalhe->titulo = $aula->desc;
            $detalhe->texto =  " ";
            $detalhe->img1 =  " ";
            $detalhe->img2 =  " ";
            $detalhe->img3 =  " ";
            $detalhe->aula_id = $id;
            $detalhe->save();
        }
 
        return view('admin.aulas.detalhe-aula')->with('aula_detalhe',$detalhe);
    }

    public function detalhe_aula_save(Request $request){
        $aula_id = $request->param1;
        $titulo = $request->param2;
        $texto = $request->param3;
        $detalhe = aula_detalhe::where('aula_id',$aula_id)->first();
 
        $detalhe->titulo = $titulo;
        $detalhe->texto = $texto;
        if($detalhe->save()){
            return response('saved',200);
        }
    }
///////////////////////////GRADE///////////////////////////////    
    public function grade_aula(){
        $grades = GradeAula::where('academia_id',auth()->user()->academia_id)->get();
        return view ( 'admin.grade-aula')
        ->with('grades',$grades);
    }
    public function form_grade($id){
        $aulas = aulas::where('academia_id',auth()->user()->academia_id)->get();
        $professores = professor::where('academia_id',auth()->user()->academia_id)->get();
        $grade="";
        $unidades = unidades::where('academia_id',auth()->user()->academia_id)->get();
        if($id > 0) $grade = GradeAula::find($id);
        return view('admin.grade.form')
                 ->with('id',$id)
                 ->with('grade',$grade)
                 ->with('aulas',$aulas)
                 ->with('professores',$professores)
                 ->with('unidades',$unidades);
    }


    public function create_grade(Request $request){
        $a = GradeAula::find($request->id);

        if(!$a) $a = new GradeAula;
        $a->aula_id = $request->aula_id;
        $a->dia = $request->dia;
        $a->hora_ini = $request->hora_ini;
        $a->hora_fim = $request->hora_fim;
        $a->status_id=$request->status_id;
        $a->academia_id = auth()->user()->academia_id;
        $a->user_id = auth()->user()->id;
        $a->professor_id = $request->professor_id;
        $a->unidade_id = $request->unidade_id;
        
        if($a->save()){
            return redirect(route('grade-aula'));
        }
    }
    public function delete_grade($id){
        $grade = GradeAula::find($id);
        if($grade->delete()){
            return response('deleted',206);
        }
    }
}
