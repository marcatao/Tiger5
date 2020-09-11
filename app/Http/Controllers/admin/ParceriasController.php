<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\parcerias;
use Intervention\Image\Facades\Image;

class ParceriasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $parcerias = parcerias::all();
        return view('admin.Parcerias.index')
             ->with('parcerias',$parcerias);
    }
    public function parceria_cadastro($id, $message=null){
        $p = parcerias::find($id);
        return view('admin.Parcerias.form')
                ->with('p',$p)
                ->with('id',$id)
                ->with('message',$message);
    }

    public function parceria_store($id, Request $request){
        $p = parcerias::find($id);
        if(!$p) $p = new parcerias;
        $p->sub_titulo = $request->sub_titulo;
        $p->titulo = $request->titulo;
        $p->texto = $request->texto;
        $p->academia_id = auth()->user()->academia_id;

          if($id == 0){
              $p->img_capa = "/img/parcerias/nofoto.png";  
          }
          if($request->File('img_capa')){ 
             $new_name = rand().'.png';
             $path="img/parcerias/";
             $img =  Image::make($request->File('img_capa'));
             $img->fit(600);
             $img->save(public_path($path).$new_name,80);
             $p->img_capa = $path.$new_name;
          }
     
        $p->save();  
        $message = ['type'=>'success','message'=>' Dados alterados !'];
        return $this->parceria_cadastro($p->id,$message);
    }

    private function ajusta_id(){

    }

    public function parceria_delete($id){
        $p = parcerias::find($id);
        $p->delete();
        $message = ['type'=>'success','message'=>' Dados alterados !'];
        return redirect(route('parcerias-index'))->with('message',$message);
    }

    public function parceria_ordem(Request $request){
        $id = $request->param1;
        $action = $request->param2;

        if($action == 'up'){
            $id_next =$id-1;
            $par = parcerias::find($id);
            $par->id = 999;
            $par->save();
            $par_troca = parcerias::find($id_next);
            $par_troca->id =$par_troca->id+1;
            $par_troca->save();
            $par->id = $id -1;
            $par->save();

        }
        if($action == 'down'){
            $id_next  = $id+1;
            $par = parcerias::find($id);
            $par->id = 999;
            $par->save();
            $par_troca = parcerias::find($id_next);
            $par_troca->id = $par_troca->id-1;
            $par_troca->save();
            $par->id = $id +1;
            $par->save();
        }
    }
}
