<?php

namespace App\Admin;
use Illuminate\Support\Facades\Hash;
use App\User;
 
class LoginCreate
{

    private $name;

    public static function CriarLogin(String $name, 
                                      String $email, 
                                      String $password, 
                                      int $academia_id, 
                                      int $profile_id){
        
         $name = ucfirst(mb_strtolower($name));
         $email = mb_strtolower($email);       
                                 
         return User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'profile_id' => $profile_id,
            'academia_id' => $academia_id,
        ]);
    }
}
