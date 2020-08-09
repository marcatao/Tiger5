<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\aluno;
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
        $user_id = $user_id->user_id;
        return view ('admin.alunos.detalhes')
                    ->with('id',$id)
                    ->with('message',$message)
                    ->with('user_id',$user_id);
    }


    public function aluno_form($id){

        $aluno = aluno::where('academia_id',auth()->user()->academia_id)->where('id',$id)->first();
        return view('admin.alunos.form')
                    ->with('id',$id)
                    ->with('aluno',$aluno);
    }





    public function store_aluno_registra(Request $request){
        $ativo = 0;
        if($request->ativo) $ativo=1;



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
            $aluno->user_id       =$user->id;         
            $aluno->created_at    =$date;
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
}
