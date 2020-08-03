@if($chamadas)
@foreach ($chamadas as $chamada)
@php

$ativo = false;
if($chamada->status_id == 1 ) $ativo=true;

$mes = ['','Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'];
$semana = ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sabado'];
$data = Carbon\Carbon::createFromFormat('d/m/Y', $chamada->dt_aula);    
@endphp
<div class="row mb-5" id="mestre_chamada_{{$chamada->id}}">
<div class="col-md-6">
    <div class="row">
        <div class="col-md-3">
          <div class="row">
            <img src="{{asset($chamada->professor->foto)}}" class="profile-user-img img-fluid">
          </div>
        <div class="row">
          <div class="col-md-12 text-center">
            <p class="mb-0 mt-3">{{$semana[$data->dayOfWeek]}}</p>
            <h1 class="mt-0 mb-0"><b>{{$data->format('d')}}</b></h1>
            <h5 class="mt-0 mt-0">{{$mes[(int)$data->format('m')]}}</h5>
            <h3 class="mt-0">{{$data->format('Y')}}</h3>
          </div>
        </div>
        </div>
        <div class="col-md-9">
         <h1 class="m-0 text-dark">{{$chamada->aula->desc}}</h1>
         <p>Horario : <b>{{$chamada->hora_ini}}</b> - <b>{{$chamada->hora_fim}}</b></p>
           <p> Status:{{$chamada->status->descricao}}</p>
            <p>Professor: {{$chamada->professor->user->name}}</p>
            @if($ativo)
            <button class="btn btn-outline-warning btn-block" onclick="altera_status('{{$chamada->id}}','3')"> Cancelar Aula </button>
            <button class="btn btn-outline-primary btn-block" onclick="altera_status('{{$chamada->id}}','4')"> Encerrar Aula</button>
            @endif
        </div>
    </div>
</div>
<div class="col-md-6">

    <div class="card" style="height: 100%;">
        <div class="card-header border-0">
          <h3 class="card-title">
            <i class="fas fas fa-users mr-1"></i>
            Alunos participantes
          </h3>
          <!-- card tools -->
          <div class="card-tools">
         @if($ativo)   
          <button type="button" class="btn btn-primary btn-sm daterange" data-toggle="tooltip" title="Adicionar Aula" onclick="carrega_lista_presenca('{{$chamada->id}}')">
              <i class="fa fa-plus"></i>
          </button>
         @endif

          </div>
          <!-- /.card-tools -->
        </div>
        <div class="card-body" style="display: block;">
          <div id="world-map" style="width: 100%;">
        
        


            <table id="aluno_chamada_{{$chamada->id}}" class="table table-bordered table-sm">
                <thead>
                <tr>
                  <th colspan="2">Aluno</th>
                  <th> </th>
                  @foreach ($chamada->chamada_aluno as $aluno)
                      <tr id="RowTable_{{$aluno->id}}">
                        <td><img src="{{asset($aluno->aluno->FotoPerfil)}}" class="profile-user-img img-fluid"></td>
                        <td>{{$aluno->aluno->nome}}</td>
                      <td> @if($ativo) <button class="btn btn-danger" onclick="deleteAlunoChamada('{{$aluno->id}}')"><i class="fas fa-trash"></i></button>@endif</td>
                      </tr>
                  @endforeach
                  
                </tr>
                </thead>
                <tbody>
 
               
                </tbody>

              </table>


        
        
        </div>
        </div>
        <!-- /.card-body-->

      </div>









    

</div>

<div class="col-md-12">
  <hr class="mb-5">  
</div>

</div>

    
@endforeach
@endif


<script>
  $(function () {
    @isset($message)
    window.Toast.fire({
        icon: '{{$message['type']}}',
        title: ' {{$message['message']}}.'
      })
    @endisset
  }); 

function carrega_lista_presenca(chamada_id){
  $('#modal').modal('show');
  $('#modal-corpo').html('loading...');
  $('#modal-titulo').html('Selecione o aluno');
  requisicao('{{route('lista-presenca-alunos')}}','GET',chamada_id)
    .then(result => {
        $('#modal-corpo').html(result);
    });
}    

function deleteAlunoChamada(id){
  requisicao('{{route('chamada-aluno')}}','delete',id)
    .then(result => {
        const r = $.parseJSON(result);
        window.Toast.fire({icon: r.type, title: r.message});
        if(r.type == 'success') $('#RowTable_'+id).hide('slow');
        console.log(r);

    });
}

function altera_status(chamada_id,status_id){
  console.log("chamada:" + chamada_id + ' status:' + status_id);
  requisicao('{{route('altera-status')}}','post',chamada_id,status_id)
    .then(result => {
        const r = $.parseJSON(result);
        window.Toast.fire({icon: r.type, title: r.message});
        if(r.type == 'success') $('#mestre_chamada_'+chamada_id).hide('slow');
        console.log(r);

    });

}
</script>