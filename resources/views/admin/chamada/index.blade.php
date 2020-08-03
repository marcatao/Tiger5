@extends('layouts.admin')

@section('estilo')


@endsection

 
@section('conteudo')
<div class="container-fluid">

  <a href="{{route('form-nova-chamada')}}" class="btn btn-primary btn-block mb-2 mt-1">Nova lista de presença</a>
 

<div class="row">
  <div class="col-md-12">


    <div class="card card-primary card-tabs">
      <div class="card-header p-0 pt-1">
        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">

          <li class="nav-item">
            <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Listas Ativas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false" onclick="carrega_lista_presenca_completa('0','custom-tabs-one-profile');">Listas Encerradas</a>
          </li>
   
 
        </ul>
      </div>
      <div class="card-body">
        <div class="tab-content" id="custom-tabs-one-tabContent">
          <div class="tab-pane fade active show" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
            <div id="abertas_chamadas"> Carregando listas de presença... </div>
          </div>
          <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
           
          </div>

        </div>
      </div>
      <!-- /.card -->
    </div>



  </div>
</div>
</div>
@include('admin.menus.modal')
@endsection

@section('scripts')
<script>
  $(function () {
    carrega_lista_presenca_completa('1','abertas_chamadas');

  });

function form_nova_chamada(){
  $('#modal').modal('show');
  $('#modal-corpo').html('loading...');
  $('#modal-titulo').html('Lista de presença');
  requisicao('{{route('form-nova-chamada')}}','GET')
    .then(result => {
      $('#modal-corpo').html(result);
    });
}

function carrega_lista_presenca_completa(status, div){
  console.log('Carregando lista de presenças');
  requisicao('{{route('lista-presenca')}}','GET',status)
    .then(result => {
      console.log('estamos aqui');
       $('#'+div).html(result);

    });
}
</script>
@endsection