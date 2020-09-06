<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\aluno;
use App\aulas_plano;
use App\GradeAula;
use App\planos;
use App\grade_aluno;
use App\Maula;

use App\User;
use App\Admin\LoginCreate;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
class AlunoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }


    public function index($message=null){
        return view('admin.alunos.lista')
        ->with('message',$message);

    }

    public function index_table($id){
        $alunos = aluno::where('academia_id',auth()->user()->academia_id)
                       ->where('ativo',$id)->get();
        return view('admin.alunos.tabela')
             ->with('alunos',$alunos)
             ->with('table','table_'.$id);
    }




    public function aluno_detalhes($id, $message=null){
        $user_id = aluno::find($id);
        if($user_id) $user_id = $user_id->user_id;
        return view ('admin.alunos.detalhes')
                    ->with('id',$id)
                    ->with('message',$message)
                    ->with('user_id',$user_id);
    }


    public function aluno_form($id){
        $maula = Maula::where('aluno_id',$id)
                ->whereIn('status_id',[1,6])
                ->count();
        $desativar=1;
        if($maula > 0) $desativar = 0;

        $aluno = aluno::where('academia_id',auth()->user()->academia_id)->where('id',$id)->first();
        return view('admin.alunos.form')
                    ->with('id',$id)
                    ->with('aluno',$aluno)
                    ->with('desativar',$desativar);
    }





    public function store_aluno_registra(Request $request){
        


        $aniversario = $request->dt_nacito;
        //data em ingles
        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$aniversario))
            $aniversario = Carbon::createFromFormat('Y-m-d', $aniversario);
        //data em br
        if (preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/[0-9]{4}$/",$aniversario))
            $aniversario = Carbon::createFromFormat('d/m/Y', $aniversario);



        $senha = preg_replace('/[^0-9]/', '', $request->dt_nacito);
        $date = Carbon::createFromFormat('d/m/Y', $request->created_at);

        $user = new User();
        $user->name = $request->nome;
        $user->email = $request->email;
        $user->password= $senha;
        $user->academia_id = auth()->user()->academia_id;
        $user->profile_id = 1; //aluno id profile
        $user = LoginCreate::CriarNovoUsuario($user);

        if($user){
            $aluno = new aluno;
            $aluno->ativo         =$request->ativo;
            $aluno->user_id       =$request->user_id    ;
            $aluno->cpf           =$request->cpf        ;
            $aluno->rg            =$request->rg         ;
            $aluno->nome          =$request->nome       ;
            $aluno->sexo          =$request->sexo       ;
            $aluno->dt_nacito     =$aniversario->format('Y-m-d') ;
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
            $aluno->user_id       =$user->id;         
            $aluno->created_at    =$date;
            $aluno->dia_venc = $request->dia_venc;
            $aluno->obs = $request->obs;
            $aluno = LoginCreate::AlunoCadastro($aluno);
        }//end if user

     
           $message = ['type'=>'success','message'=>' Dados alterados !'];
           return $this->aluno_detalhes($aluno->id,$message);
    }

    public function change_status(Request $request){
        $id = $request->param1;
        $status = $request->param2;
        $aluno = aluno::find($id);
        $aluno->ativo = $status;
        $aluno->save();
        $message = ['type'=>'success','message'=>' Dados alterados !'];
        return $this->index($message);

    }

    public function foto_form(Request $request){
        return view('admin.alunos.foto-form')->with('id',$request->param1);
    }

    public function foto_form_save(Request $request){
        $aluno = aluno::find($request->id);
        if($aluno){
        if($request->File('file')){ 
            $image = $request->File('file');
            $new_name = rand().'.png';
            $path="admin/profiles/";
            
            $img =  Image::make($request->File('file'));
            $img->fit(600);
            $img->save(public_path($path).$new_name,80);

            chmod(public_path($path).$new_name,0777);
            $aluno->foto = $path.$new_name;
                if($aluno->save()){
                    $message = ['type'=>'success','message'=>' Foto Alterada com sucesso!'];
                    return $this->aluno_detalhes($aluno->id,$message);
                }
           }
        }
    }

    public function deleta_form(Request $request){
        $aluno = aluno::find($request->param1);
 
        return view('admin.alunos.confirma-del')->with('aluno',$aluno);
        
    }

    public function del(Request $request){
        $aluno = aluno::find($request->id);
        if($aluno){
            $user = User::where('email', $aluno->email)->first();
            if($user) $user->delete();
            $aluno->delete();
            $message = ['type'=>'success','message'=>' Registro deletado !'];
            return $this->index($message);
        }
    }

    public function horario_aluno(Request $request){
        $aluno = aluno::find($request->param1);
        return view('admin.alunos.horarios.exibe-horarios-aluno')
        ->with('aluno',$aluno);
    }
    public function selecao_grade_aluno(Request $request){
        $aluno_id = $request->param1;
        $plano_id = $request->param2;
        $plano = planos::find($plano_id);

        $aulas = aulas_plano::where('plano_id',$plano_id)
                            ->pluck('aula_id')->toArray();

        $grades = GradeAula::whereIn('aula_id',$aulas)
                           ->where('status_id',1)
                           ->get();
        
        $grade_aluno = grade_aluno::where('grade_aluno.aluno_id',$aluno_id)
                                  ->join('GradeAula', 'GradeAula.id','=','grade_aluno.GradeAula_id')
                                  ->whereIn('GradeAula.aula_id',$aulas)
                                  ->pluck('grade_aluno.gradeAula_id')
                                  ->toArray();

        $qt_disponivel = $plano->qtd_aulas_semanais - count($grade_aluno);
        return view('admin.alunos.horarios.selecao-grade-aluno')
        ->with('grade_aluno',$grade_aluno)
        ->with('grades',$grades)
        ->with('qt_disponivel',$qt_disponivel)
        ->with('aluno_id',$aluno_id);
    
    }

    public function selecao_grade_aluno_store(Request $request){
        $action = $request->param1;
        $gradeAula_id = $request->param2;
        $aluno_id = $request->param3;

        $old = grade_aluno::where('aluno_id',$aluno_id)
                            ->where('gradeAula_id', $gradeAula_id)
                            ->first();
        
        if($old) $old->delete();
        
        if($action == 'true'){
            $new = new grade_aluno();
            $new->aluno_id = $aluno_id;
            $new->gradeAula_id = $gradeAula_id;
            $new->save();
            return 'true';
        }
        return 'false';
    }


}
