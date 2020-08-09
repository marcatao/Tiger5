<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\profiles;
use App\historico;
use App\Admin\LoginCreate;

class LoginController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
     }


    public function index(Array $message=null){
 
        $logins = user::where('academia_id',auth()->user()->academia_id)->get();
         return view('admin.login.lista')
        ->with('logins',$logins)
        ->with('message',$message);
    }
 
    public function create_form(Array $message=null,User $user=null){
        $profiles = profiles::all();
        return view('admin.login.form')->with('profiles',$profiles)
        ->with('message',$message)
        ->with('user',$user);
    }

    public function create(Request $request){
        $email = mb_strtolower($request->email);
        $name =  $request->name;
        $user=User::where('email',$email)->first();
        if($user) return $this->create_form(['type'=>'error','message'=>'O email: '.$email.' ja está cadastrado no sistema'],$user);
        $login = "";
        $login  = LoginCreate::CriarLogin($name,$email,$request->senha,auth()->user()->academia_id,2);
        if($login) return $this->index(['type'=>'success','message'=>'Cadastro realizado com sucesso']);
    }

    public function editarlogin($id){
        $user = User::find($id);
        return $this->create_form(null,$user);
    }

    public function historico_user(Request $request){
        $user_id = $request->param1;
        $historico = historico::where('user_id',$user_id)->get();
        return view('admin.historico.lista')->with('historicos',$historico);
    }


} 
