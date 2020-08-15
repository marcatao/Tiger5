<?php

namespace App\Http\Controllers\admin\relatorios;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FaturasController extends Controller
{
   public function faturas(){
       return view('admin.relatorios.mensalidades');
   }
}
