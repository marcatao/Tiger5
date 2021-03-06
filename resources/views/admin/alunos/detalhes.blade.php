@extends('layouts.admin')


@section('conteudo')


<div class="container-fluid">

 
 


                <div class="row">
                    <div class="col-md-12">
                      <div class="card card-primary card-tabs">
                        <div class="card-header p-0 pt-1">
                          <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Cadastro</a>
                            </li>

                            <li class="nav-item">
                              <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false" onclick="plano_aluno()">Planos</a>
                            </li>
                            
                            <li class="nav-item">
                              <a class="nav-link" id="horario_aluno-tab" data-toggle="pill" href="#horario_aluno" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false" onclick="horario_aluno()">Horários</a>
                            </li>

                            <li class="nav-item">
                              <a class="nav-link" id="hitorico-do-aluno-tab" data-toggle="pill" href="#hitorico-do-aluno" role="tab" aria-controls="hitorico-do-aluno" aria-selected="false" onclick="historico_aluno()">Historico</a>
                            </li>

                          </ul>
                        </div>
                        <div class="card-body">

                          <div class="tab-content" id="custom-tabs-one-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                               Loading...<!--cadastros-->
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                               Loading...<!--Planos -->
                            </div>
                            <div class="tab-pane fade" id="horario_aluno" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                              Loading horarios...<!--horario_aluno -->
                           </div>
                            <div class="tab-pane fade" id="hitorico-do-aluno" role="tabpanel" aria-labelledby="hitorico-do-aluno-tab">
                              Loading historico...<!--Planos -->
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

  form_request();

  @isset($message)
      window.Toast.fire({
        icon: '{{$message['type']}}',
        title: ' {{$message['message']}}.'
      });
    @endisset
 });


 function form_request(){
  requisicao('{{route('aluno-form',$id)}}','GET')
    .then(result => {
        $("#custom-tabs-one-home").html(result);
    });
}

function plano_aluno(){
  requisicao('{{route('aluno-plano',$id)}}','GET')
    .then(result => {
        $("#custom-tabs-one-profile").html(result);
    });
}

function historico_aluno(){
  requisicao('{{route('historico-user')}}','get', '{{$user_id}}')
    .then($("#hitorico-do-aluno").html("Carregando, aguarde..."))
    .then(result => {
        $("#hitorico-do-aluno").html(result);
    });
}
function horario_aluno(){
  requisicao('{{route('horario-aluno')}}','get', '{{$id}}')
    .then($("#horario_aluno").html("Carregando, aguarde..."))
    .then(result => {
        $("#horario_aluno").html(result);
    });
}


</script>
@endsection