<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\professor;
use App\user;


class professorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
 
    }
    public function index(){
        $professor = professor::where('academia_id',auth()->user()->academia_id)->get();
        return view('admin.professor')
        ->with('professores',$professor);
    }
    public function form_professor($id){
        $professor="";
        $users = user::where('academia_id',auth()->user()->academia_id)->get();
        if($id > 0) $professor = professor::find($id);
        return view('admin.professor.form')
                 ->with('id',$id)
                 ->with('professor',$professor)
                 ->with('users',$users);
    }

    public function create_professor(Request $request){
        $a = professor::find($request->id);
        if(!$a) $a = new professor;

      if($request->File('file')){ 
        $image = $request->File('file');
        $new_name = rand().'.png';
        $path="site/".auth()->user()->academia_id."/uploads/";
        $image->move(public_path($path),$new_name);
        chmod(public_path($path).$new_name,0777);
        $a->foto = $path.$new_name;
       }

        $a->user_id = $request->user_id;
        $a->habilidades = $request->habilidades;

        
        $a->academia_id = auth()->user()->academia_id;

        if($a->save()){
            return redirect(route('professor'));
        }
    }

    public function delete_professor($id){
        $professor = professor::find($id);
        if($professor->delete()){
            return redirect(route('professor'));
        }
    }


    
}
