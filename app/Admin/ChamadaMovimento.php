<?php

namespace App\Admin;

use Carbon\Carbon;

use App\planos;
use App\aluno;
use App\FormaPagamento;
use App\aulas_plano;
use App\aulas;
use App\Maula;
use App\Faula;
use App\chamada;
use App\chamada_aluno;

 
class ChamadaMovimento
{

    public static function CriarChamada(chamada $chamada){
        $ChamadaDuplicada = chamada::where('professor_id',$chamada->professor_id)
                                   ->where('aula_id',$chamada->aula_id)
                                   ->where('dt_aula',$chamada->dt_aula)
                                   ->where('hora_ini',$chamada->hora_ini)
                                   ->where('hora_fim',$chamada->hora_fim)
                                   ->where('status_id',$chamada->status_id)
                                   ->first();
        if(!$ChamadaDuplicada){
            $chamada->save();
            return $chamada;
        }else{
            return $ChamadaDuplicada;
        }                                   

    }
/////////////////////////////////////////////////////////////////////////////////////////////

//**************************************************************************************** */
    public static function AlunosComCredito(aulas $aula,chamada $chamada=null){
        if(!$chamada){
            $Faula = Faula::where('aula_id',$aula->id)
                           ->where('status_id','10')
                           ->groupby('aluno_id')
                           ->get();
            return $Faula;
        }

            $chamada_aluno = chamada_aluno::where('chamada_id',$chamada->id)
                                          ->pluck('aluno_id')
                                          ->toArray();
            $Faula = Faula::where('aula_id',$aula->id)
                          ->where('status_id','10')
                          ->whereNotIn('aluno_id',$chamada_aluno)
                          ->groupby('aluno_id')
                          ->get();
            return $Faula;

    } 
///////////////////////////////////////////////////////////////////////////////////////////////

//****************************************************************************************** */
    public static function TemCredito(chamada $chamada, aluno $aluno){
        $Faula = Faula::where('aula_id',$chamada->aula_id)
                        ->where('status_id','10')
                        ->where('aluno_id',$aluno->id)
                        ->get();
        if($Faula) return true;
        return false;
    }
///////////////////////////////////////////////////////////////////////////////////////////////

//******************************************************************************************** */
    public static function IncluirAlunoChamada(chamada $chamada, aluno $aluno){
        if(!ChamadaMovimento::TemCredito($chamada,$aluno)) 
        return "Aluno nao possui credito para essa Aula";

        $chamada_aluno = new chamada_aluno();
        $chamada_aluno->chamada_id = $chamada->id;
        $chamada_aluno->aluno_id = $aluno->id;
        if($chamada_aluno->save()){
            //Associar a lista de chamada a aula
            $Faula  = Faula::where('aula_id',$chamada->aula_id)
                           ->where('aluno_id',$aluno->id)
                           ->where('status_id',10)
                           ->first();
            $Faula->professor_id = $chamada->professor_id;
            $Faula->dt_utilizacao = $chamada->dt_aula;
            $Faula->status_id = 9;
            $Faula->chamada_aluno_id = $chamada_aluno->id;
            if($Faula->save()){
                $message = ['type'=>'success','message'=>'Aula incluida na lista de presença','aluno'=> $aluno,'chamada_aluno_id'=>$Faula->chamada_aluno_id];
                return response()->json($message);
            }else{
                $chamada_aluno->delete();
                return "erro";
            }                           
        }
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////
    
    //******************************************************************************************** */

    public static function ExcluirAlunoChamada(chamada_aluno $chamada_aluno){
        $Faula = Faula::where('chamada_aluno_id',$chamada_aluno->id)->first();
        $Faula->professor_id=null;
        $Faula->dt_utilizacao = null;
        $Faula->status_id = 10;
        $Faula->chamada_aluno_id=null;
        if($Faula->save()){
            if($chamada_aluno->delete()){
                $message = ['type'=>'success','message'=>'Aluno removido da lista de presença'];
                return response()->json($message);
            }else{
                return "Erro ao deletar chamada_aluno";
            }
        }
    }

///////////////////////////////////////////////////////////////////////////////////////////////

//******************************************************************************************** */
    public static function AlteraStatusChamada(chamada $chamada, int $status_id){
        $status_id = (int) $status_id;
        $chamada_aluno = chamada_aluno::where('chamada_id',$chamada->id)->get();

        //Encerrando chamada, com aula finalizada....
        if($status_id == 4){
            if(count($chamada_aluno) <= 0) return response()->json(['type'=>'error','message'=>'Atenção, Não e possivel encerrar uma lista de presenca sem alunos, cancele caso necessário!']);

            foreach($chamada_aluno as $lista_aluno){
                $Faula = Faula::where('chamada_aluno_id',$lista_aluno->id)->first();
                $Faula->status_id = 7;
                $Faula->save();
            }
            $chamada->status_id=4;
            $chamada->save();
            return response()->json(['type'=>'success','message'=>'Lista de presença encerrada com sucesso!']);

        }//FIM tratamento status4 - encerrando lista de chamada

        //Cancelando uma Aula
        if($status_id == 3){
            if(count($chamada_aluno) > 0){
                foreach($chamada_aluno as $lista_aluno){
                    ChamadaMovimento::ExcluirAlunoChamada($lista_aluno);
                }
            }
            $chamada->status_id=3;
            $chamada->save();
            return response()->json(['type'=>'success','message'=>'Lista de presença cancelada com sucesso!']);
        }//FIM tratamento status3 -cancelando uma aula;    

        return response()->json("ola");
    }

///////////////////////////////////////////////////////////////////////////////////////////////

//******************************************************************************************** */
}