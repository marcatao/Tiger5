<h2>Planos do Aluno</h2>

@foreach (App\Maula::where('aluno_id',$aluno->id)
                   ->whereIn('status_id',[1,6])
                   ->get() as $planos)
    <table style="width: 100%">                   
    <thead>
        <th>{{$planos->plano->titulo_plano}} - {{$planos->plano->qtd_aulas_semanais}} aulas semanalmente.</th>
        <th class="justify-content-end"><button class="btn btn-primary" onclick="select_grade('{{$planos->plano->id}}')">Editar Grade Aula</button></th>
    </thead>
    <tbody>
        @php
        
        $aulas = App\aulas_plano::where('plano_id',$planos->plano->id)
                            ->pluck('aula_id')->toArray();

        $grade_aluno = App\grade_aluno::where('grade_aluno.aluno_id',$aluno->id)
                                  ->join('GradeAula', 'GradeAula.id','=','grade_aluno.GradeAula_id')
                                  ->whereIn('GradeAula.aula_id',$aulas)
                                  ->pluck('grade_aluno.gradeAula_id')
                                  ->toArray();

        $horarios = App\GradeAula::whereIn('id', $grade_aluno)->get();

        @endphp

        @foreach ($horarios as $grade)
            <tr>
                <td>{{$grade->dia}} ({{$grade->hora_ini}} - {{$grade->hora_fim}})</td>  
                <td> </td> 
                
            </tr>            
        @endforeach
    </tbody>
    </table>
    <hr>
@endforeach







<script>

function select_grade(plano_id){
    const aluno_id = '{{$aluno->id}}';
  $('#modal').modal('show');
  $('#modal-corpo').html('loading...');
  $('#modal-titulo').html('Selecione a Grade Semanal:');
  requisicao('{{route('selecao_grade_aluno')}}','get',aluno_id,plano_id)
    .then(result => {
      $('#modal-corpo').html(result);
    });
}
</script>