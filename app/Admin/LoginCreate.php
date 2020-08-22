<?php

namespace App\Admin;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\aluno;
use App\Admin\HistoricoMovimento;

class LoginCreate
{

    private $name; 

    public static function CriarLogin(String $name, 
                                      String $email, 
                                      String $password, 
                                      int $academia_id, 
                                      int $profile_id){
        
         $name = ucwords(mb_strtolower($name)); 
         $email = mb_strtolower($email);       
                                 
         return User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'profile_id' => $profile_id,
            'academia_id' => $academia_id,
        ]);
    }


    public static function CriarNovoUsuario(User $userPass){
        $user = User::where('email',$userPass->email)->first();
        if(!$user){
            $user = new User();
            $user->email = $userPass->email;
            $user->password = Hash::make($userPass->password);
        }
        $user->name = ucwords(mb_strtolower($userPass->name));
        if($user->profile_id <> 0) $user->profile_id = $userPass->profile_id;
        $user->academia_id = $userPass->academia_id;
        $user->save();
        return $user;   

    }

    public static function AlunoCadastro(aluno $alunoPass){
        $aluno = aluno::where('cpf',$alunoPass->cpf)->first();
        $mensagem_historico = " Cadastro do aluno alterado";
        if(!$aluno){
            $aluno = new aluno();
            $aluno->cpf = $alunoPass->cpf;
            $mensagem_historico = " Cadastro do aluno realizado";
        }

        $aluno->ativo         =$alunoPass->ativo;
        $aluno->user_id       =$alunoPass->user_id    ;
        $aluno->rg            =$alunoPass->rg         ;
        $aluno->nome          =ucwords(mb_strtolower($alunoPass->nome));
        $aluno->sexo          =$alunoPass->sexo       ;
        $aluno->dt_nacito     =$alunoPass->dt_nacito  ;
        $aluno->tel           =$alunoPass->tel        ;
        $aluno->cel1          =$alunoPass->cel1       ;
        $aluno->operadora1    =$alunoPass->operadora1 ;
        $aluno->cel2          =$alunoPass->cel2       ;
        $aluno->operadora2    =$alunoPass->operadora2 ;
        $aluno->email         =$alunoPass->email      ;  
        $aluno->cep           =$alunoPass->cep        ;
        $aluno->rua           =$alunoPass->rua        ;
        $aluno->numero        =$alunoPass->numero     ;
        $aluno->bairro        =$alunoPass->bairro     ;
        $aluno->cidade        =$alunoPass->cidade     ;
        $aluno->estado        =$alunoPass->estado     ;
        $aluno->complemento   =$alunoPass->complemento;   
        $aluno->academia_id   =$alunoPass->academia_id;
        $aluno->user_id       =$alunoPass->user_id;         
        $aluno->created_at    =$alunoPass->created_at;
        $aluno->obs    =$alunoPass->obs;
        $aluno->save();
          $array = ['to_user_id' => $aluno->user_id,'icon' => 'fas fa-envelope bg-blue','mensagem' => $mensagem_historico ];  
          $historico =  HistoricoMovimento::CreateHistorico($array);
        
        return $aluno;

    }
}
