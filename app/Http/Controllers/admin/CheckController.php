<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Maula;
use Carbon\Carbon;

use App\Mail\AjustePlanosDiario;
use Illuminate\Support\Facades\Mail;

class CheckController extends Controller
{
    public function index(){

        //select * from Maula
        //where renovacao = 1 AND
        //cast(strftime('%m',dt_pagamento) as integer) < cast(strftime('%m',date('now')) as integer)
        
        //$dt = Carbon::now();
        //$dt->addMonths(-1);
        //$planos_renocao = Maula::where('renovacao',1)
        //                 ->where('dt_pagamento','<=', $dt) ->get();

        $dt = Carbon::now();
        $dt->addMonths(-1);
        $planos_renocao = Maula::where('renovacao',1)
                               ->whereMonth('dt_pagamento','<', '08')
                               ->whereNull('sub')
                               ->get();
        Mail::to('thiagomarcato@gmail.com')->send(new AjustePlanosDiario());                               
        dd($planos_renocao);
        return $planos_renocao;
    }
}
