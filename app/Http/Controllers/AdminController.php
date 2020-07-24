<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\aluno;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $alunos = aluno::where('academia_id',auth()->user()->academia_id)->where('ativo','1')->get();
        return view('admin.index')
        ->with('alunos',$alunos);
    }

}
