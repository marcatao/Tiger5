<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Instagram\Api;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

use App\aulas;
use App\aula_detalhe;
use App\GradeAula;
use App\professor;
use App\User;
use App\unidades;
use App\planos;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;


class SiteController extends Controller
{

   protected $academia_id; 

    public function __construct()
    {
        $this->academia_id= 1;
    }


    public function index(){
    
        try {
            $midias = $this->instagram();
        } catch (\Throwable $th) {
            $midias = null;
        }
        
        $aulas  = aulas::where('academia_id',$this->academia_id)->get();
        $unidades = unidades::where('academia_id',$this->academia_id)->get();
        return view('site.index')
        ->with('midias',$midias)
        ->with('aulas',$aulas)
        ->with('unidades',$unidades);
    }
    public function sobre_nos(){
        $aulas  = aulas::where('academia_id',$this->academia_id)->get();
        $professores  = professor::where('academia_id',$this->academia_id)->get();
        return view('site.sobre-nos')
        ->with('professores',$professores)
        ->with('aulas',$aulas);
    }
    public function acao_social(){
        return view('site.acao-social');
    }

    public function aulas(){
        $aulas  = aulas::where('academia_id',$this->academia_id)->get();
        $segunda = $this->grade_dia('Segunda');
        $terca = $this->grade_dia('Terça');
        $quarta = $this->grade_dia('Quarta');
        $quinta = $this->grade_dia('Quinta');
        $sexta = $this->grade_dia('Sexta');
        $sabado = $this->grade_dia('Sabado');
        $domingo = $this->grade_dia('Domingo');
        $planos = planos::where('academia_id',$this->academia_id)->where('visivel_site','1')->get();
        return view('site.aulas')
                ->with('aulas',$aulas)
                ->with('segunda',$segunda)
                ->with('terca',$terca)
                ->with('quarta',$quarta)
                ->with('quinta',$quinta)
                ->with('sexta',$sexta)
                ->with('sabado',$sabado)
                ->with('domingo',$domingo)
                ->with('planos',$planos);
    }

    public function aula_detalhe(Request $request){
        $link = $request->route()->action['as'];
        $aula = aulas::where('link',$link)->first();
        $detalhe = aula_detalhe::where('aula_id',$aula->id)->first();
        return view('site.aula-detalhe')->with('aula',$detalhe);
    }
    public function grade_dia($dia){
       return   GradeAula::where('academia_id', $this->academia_id)
        ->where('dia',$dia)
        ->where('status_id','1')
        ->orderBy('hora_ini','asc')
        ->get();      
    }

    public function contato(){
        $aulas  = aulas::where('academia_id',$this->academia_id)->get();
        return view('site.contato')
        ->with('aulas',$aulas);
    }

    public function contato_send(Request $request){

        $admin = User::where('academia_id', $this->academia_id)
                       ->where('profile_id','0')
                       ->get();
        foreach ($admin as $u) {
            Mail::to($u->email)->send(new ContactMail($request));
        }
        
        return redirect(route('index'));

    }



    public function instagram(){

    //https://github.com/pgrimaud/instagram-user-feed#installation-of-version-50   
    $cache = new FilesystemAdapter('Instagram', 0, __DIR__ . '/../cache');
    $api   = new Api($cache);
    $api->login('username', 'password');
    $profile = $api->getProfile('tigerthaibr');    
    $midias = $profile->getMedias();
    return $midias;
  
    }

 
}
