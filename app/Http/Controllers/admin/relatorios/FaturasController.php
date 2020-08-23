<?php

namespace App\Http\Controllers\admin\relatorios;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Maula;
use Carbon\Carbon;

class FaturasController extends Controller
{
   public function faturas(){
       return view('admin.relatorios.mensalidades.form');
   }

   public function faturas_dados(Request $request){

        $dt1 = $this->ajusta_data($request->param1['dt1']);
        $dt2 = $this->ajusta_data($request->param1['dt2']);
        $status_id = $request->param1['status_id'];

        if (in_array("1", $status_id)) {
            if (in_array("6", $status_id)) {
                $Maula = Maula::whereBetween('dt_pagamento',[$dt1,$dt2])->get();
            }else{
                $Maula = Maula::whereBetween('dt_pagamento',[$dt1,$dt2])
                ->where('valor_pago','>',0)->get();
            }    
        }else if (in_array("6", $status_id)) {
            $Maula = Maula::whereBetween('dt_pagamento',[$dt1,$dt2])
            ->where('valor_pago',0)->get();
        }       
       
                       
                    

         return view('admin.relatorios.mensalidades.dados')
         ->with('Maula',$Maula);
   }
 




   private function ajusta_data($dt){
       if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$dt))
            $dt = Carbon::createFromFormat('Y-m-d', $dt);
       if (preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/[0-9]{4}$/",$dt))
           $dt = Carbon::createFromFormat('d/m/Y', $dt);
       return $dt->format('Y-m-d') ;
   }
}
