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
        $professor = professor::find($id);

        return view('admin.professor.form')
                 ->with('id',$id)
                 ->with('professor',$professor)
                 ->with('message',$message);
    }

    public function create_professor($id,Request $request){
        $user = User::where('email',$request->email)->first();
        
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
            $professor->dt_nacito = $request->dt_nacito;
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
        
}
