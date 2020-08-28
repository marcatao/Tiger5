<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\professor;
use App\user;
use App\Admin\LoginCreate;
use Intervention\Image\Facades\Image;
use App\unidades;
use App\UnidadeProfessor;
use Carbon\Carbon;
use App\aulas;
use App\aulas_professor;

class ProfessorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
 
    }
    public function index($message=null){
        $professor = professor::where('academia_id',auth()->user()->academia_id)->get();
        return view('admin.professor.lista')
        ->with('professores',$professor)
        ->with('message',$message);
    }
    public function form_professor($id, $message=null){
        $professor = null;
        $user = null;
        $professor = professor::find($id);
        if($professor) $user = user::where('id',$professor->user_id)->first();
        
        return view('admin.professor.form')
                 ->with('user',$user)
                 ->with('id',$id)
                 ->with('professor',$professor)
                 ->with('message',$message);
    }

    public function create_professor($id,Request $request){

        if($id <> 0){
            $prof = professor::find($id);
            $user = User::find($prof->user_id);
        }

    
        $aniversario = $request->dt_nacito;
        //data em ingles
        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$aniversario))
            $aniversario = Carbon::createFromFormat('Y-m-d', $aniversario);
        //data em br
        if (preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/[0-9]{4}$/",$aniversario))
            $aniversario = Carbon::createFromFormat('d/m/Y', $aniversario);
        
        if(!$user){
            $senha = preg_replace('/[^0-9]/', '', $request->dt_nacito);
            $user = LoginCreate::CriarLogin($request->name, $request->email, $senha, auth()->user()->academia_id, 1);
        }
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
            $professor = professor::find($id);
            if(!$professor) $professor = new professor();

            $professor->user_id = $user->id;
            $professor->habilidades = $request->habilidades;
            $professor->academia_id = auth()->user()->academia_id;
            $professor->dt_nacito = $aniversario->format('Y-m-d');
            $professor->cpf           =$request->cpf        ;
            $professor->rg            =$request->rg         ;
            $professor->sexo          =$request->sexo       ;
            $professor->tel           =$request->tel        ;
            $professor->cel1          =$request->cel1       ;
            $professor->operadora1    =$request->operadora1 ;
            $professor->cel2          =$request->cel2       ;
            $professor->operadora2    =$request->operadora2 ;
            $professor->cep           =$request->cep        ;
            $professor->rua           =$request->rua        ;
            $professor->numero        =$request->numero     ;
            $professor->bairro        =$request->bairro     ;
            $professor->cidade        =$request->cidade     ;
            $professor->estado        =$request->estado     ;
            $professor->complemento   =$request->complemento;
            if($professor->save()){
                $message = ['type'=>'success','message'=>' Dados alterados !'];
            }

        return $this->form_professor($professor->id,$message);

                //   if($request->File('file')){ 
                //     $image = $request->File('file');
                //     $new_name = rand().'.png';
                //     $path="site/".auth()->user()->academia_id."/uploads/";
                //     $image->move(public_path($path),$new_name);
                //     chmod(public_path($path).$new_name,0777);
                //     $a->foto = $path.$new_name;
                //    }
        
    }

    public function delete_professor($id){
        $message = ['type'=>'danger','message'=>' Erro ao deletar !'];
        $professor = professor::find($id);
        if($professor){
            $user = User::find($professor->user_id);
            if($professor->delete()){
                $message = ['type'=>'success','message'=>' Professor deletado !'];
                $user->delete();
            }
        }
        return $this->index($message);
    }



    public function foto_form(Request $request){
        return view('admin.professor.foto-form')->with('id',$request->param1);
    }

    public function foto_form_save(Request $request){
        //http://image.intervention.io/
        $professor = professor::find($request->id);
        if($professor){
        if($request->File('file')){ 
            $new_name = rand().'.png';
            $path="admin/profiles/";

            $img =  Image::make($request->File('file'));
            $img->fit(600);
            $img->save(public_path($path).$new_name,80);

            chmod(public_path($path).$new_name,0777);
            $professor->foto = $path.$new_name;
                if($professor->save()){
                    $message = ['type'=>'success','message'=>' Foto alterada com sucesso !'];
                    return $this->form_professor($professor->id,$message);
                }
           }
        }
    }


    public function form_unidade(Request $request){
        $professor_id = $request->param1;
        $unidades = unidades::where('academia_id',auth()->user()->academia_id)->get();
        return view('admin.professor.form-unidade')->with('professor_id',$professor_id)->with('unidades',$unidades);
    }

    public function form_unidade_save(Request $request){
        $up = UnidadeProfessor::where('unidade_id',$request->unidade_id)->where('professor_id',$request->professor_id)->first();
        if(!$up) $up = new UnidadeProfessor();
        $up->unidade_id = $request->unidade_id;
        $up->professor_id = $request->professor_id;
        if($up->save()){
            $message = ['type'=>'success','message'=>' Unidade cadastrada com sucesso !'];
        }

        return $this->form_professor($up->professor_id,$message);
        
    }

    public function delete_unidade($id){
        $up = UnidadeProfessor::find($id);
       
        if($up){
            $professor_id = $up->professor_id;
            $up->delete();
            $message = ['type'=>'success','message'=>' Unidade deletada com sucesso !'];
            return $this->form_professor($professor_id,$message);
        }

    }



    public function form_aula(Request $request){
        $professor_id = $request->param1;
        $aulas = aulas::where('academia_id',auth()->user()->academia_id)->get();
        return view('admin.professor.form-aula')->with('professor_id',$professor_id)->with('aulas',$aulas);
    }

    public function form_aula_save(Request $request){
        $up = aulas_professor::where('professor_id',$request->professor_id)
                             ->where('aula_id',$request->aula_id)->first();
        if(!$up) $up = new aulas_professor();
        $up->professor_id = $request->professor_id;
        $up->aula_id = $request->aula_id;
        if($up->save()){
            $message = ['type'=>'success','message'=>' Modalidade cadastrada com sucesso !'];
        }

        return $this->form_professor($up->professor_id,$message);
        
    }

    public function form_aula_delete($id){
        $ap = aulas_professor::find($id);
        if($ap){
            $professor_id=$ap->professor_id;
            $message = ['type'=>'success','message'=>' Modalidade excluida com sucesso !'];
            $ap->delete();
        }
        return $this->form_professor($professor_id,$message);
    }
}
