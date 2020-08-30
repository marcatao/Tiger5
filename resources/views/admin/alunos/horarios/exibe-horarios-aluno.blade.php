<h2>Planos do Aluno</h2>

@foreach (App\Maula::where('aluno_id',$aluno->id)
                   ->whereIn('status_id',[1,6])
                   ->get() as $planos)
    <table style="width: 100%">                   
    <thead>
        <th>{{$planos->plano->titulo_plano}}</th>
        <th class="justify-content-end"><button class="btn btn-primary" onclick="select_grade('{{$planos->plano->id}}')"> + Horario</button></th>
    </thead>

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