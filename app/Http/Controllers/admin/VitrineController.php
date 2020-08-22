<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\vitrine;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use App\vitrine_img;
use Illuminate\Support\Facades\Storage;

class VitrineController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }


   public function index(){
       $vitrines = vitrine::where('academia_id',auth()->user()->academia_id)->get();
       return view('admin.vitrine.index')->with('vitrines',$vitrines);
   }

   public function vitrine_form(array $message=null,vitrine $vitrine=null){
    return view('admin.vitrine.form')->with('message',$message)->with('vitrine',$vitrine);
   }

   public function vitrine_save(Request $request){
        $validatedData = $request->validate([
              'produto' => 'required|max:255',
              'valor' => 'required',
         ]);

         $vt = vitrine::find($request->id);
         if(!$vt) $vt = new vitrine;
         $vt->produto = $request->produto;
         $vt->descritivo = $request->descritivo;
         $vt->valor = $request->valor;
         $vt->desconto = 0;
         $vt->ativo = $request->ativo;
         $vt->exibe_valor = $request->exibe_valor;
         $vt->academia_id = auth()->user()->academia_id;
         $vt->save();
         $message = ['type'=>'success','message'=>' Cadastro realizado !'];
         return $this->vitrine_form($message, $vt);

   }

   public function vitrine_edit($id){
       $vitrine = vitrine::find($id);
       return $this->vitrine_form(null,$vitrine);
   }
   public function vitrine_delete($id){
    $vitrine = vitrine::find($id);
    $vitrine->delete();
    return $this->index();
}


public function vitrine_imagem_form(Request $request){
    return view('admin.vitrine.image-form')->with('vitrine_id',$request->param1);
}

    
public function vitrine_imagem_save(Request $request){
    $vt = vitrine::find($request->id);
    if($vt){
        if($request->File('file')){ 
            $image = $request->File('file');
            $new_name = rand().'.png';
            $path="admin/vitrine/";
            $img =  Image::make($request->File('file'));
            $img->fit(600);
            $img->save(public_path($path).$new_name,80);

            $img_vt = new vitrine_img();
            $img_vt->src= $path.$new_name;
            $img_vt->principal = 0;
            $img_vt->vitrine_id = $vt->id;
            $img_vt->save();

            chmod(public_path($path).$new_name,0777);
             
           }
      }
    $message = ['type'=>'success','message'=>' ImagemAtualizada !'];
    return $this->vitrine_form($message, $vt);

}

public function vitrine_imagem_delete($id){
    $vt_img = vitrine_img::find($id);
    if($vt_img){
        $vt = vitrine::find($vt_img->vitrine_id);
        $file = public_path($vt_img->src);
        Storage::delete($file);
        $vt_img->delete();
        $message = ['type'=>'success','message'=>' Imagem deletada !'];
    }
        return $this->vitrine_form($message, $vt);
}
   
}
