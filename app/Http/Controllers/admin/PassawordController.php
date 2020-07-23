<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\profiles;
use App\Admin\LoginCreate;

use App\Mail\Forgot_password;
use Illuminate\Support\Facades\Mail;

class PassawordController extends Controller
{
    public function forgot_password(){
        return view('admin.login.forgot-password');
    }

    public function forgot_password_send(Request $request){

        $user = User::where('email',$request->email)->first();
        
        if($user){
            $user->remember_token = str_random(60);
            if($user->save()){
                Mail::to($user->email)->send(new Forgot_password($user));
                return view('admin.login.email-recuperacao-enviado');
            }
        }else{
            return view('admin.login.forgot-password')
            ->with('message','E-mail não está cadastrado em nosso sistema, por favor insira o e-mail correto ou converse com a administração');
        }
       
       
    } 

    public function form_novasenha(Request $request){
        $token = $request->route()->action['as'];
        return view('admin.login.troca_senha_form')->with('token',$token);
    }

    public function password_update(Request $request){
        $pw1 = $request->pw1;
        $token = $request->token;
    
        $user = user::where('remember_token',$token)->first();
      
        $user->password = bcrypt($pw1);
        $user->remember_token = null;
        if($user->save()){
            $message = "Senha alterada com sucesso, pode realizar o login novamente com sua senha";
        }else{
            $message = "Falha ao tentar alterar sua senha tente novamente em alguns minutos";
        }
        return view('admin.login.senha_alterada')->with('message',$message);
    }
}
