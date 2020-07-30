@extends('layouts.admin')


@section('conteudo')
<div class="container-fluid">

    <br>
    <div class="card">
              <div class="card-header">
                <h3 class="card-title">Edição Professor</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                @php   $fotoPerfil = '/admin/profiles/nofoto.png'   @endphp
                @isset($professor)
                  @php   $fotoPerfil = $professor->FotoPerfil;   @endphp
                @endisset


                <div class="row">
                  <div class="col-md-2 text-center">

   
                  <label>Foto do perfil:</label>
                  <a href="#" alt="clique para alterar foto" onclick="modal()">
                  <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle  elevation-2" src="{{asset($fotoPerfil)}}" alt="User profile picture">
                    <p class="text-center"> Alterar Foto </p>
                  </div>
                  
                  </a>
           

              </div>
            <div class="col-md-6">
                  <form method="post" action="{{route('form-professor',$id)}}"  enctype="multipart/form-data">
                    {{  csrf_field() }}
                    <input type="hidden" value="{{$id}}" id="id" name="id">

                    <div class="row">
                    <div class="col-md-8">
                     <label for="email">Email</label>
                      <input type="email" name="email" id="email" class="form-control" @isset($professor) value="{{$professor->user->email}}" @endisset required>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Data Nascimento</label>
                        <div class="input-group">
                             <div class="input-group-prepend">
                               <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                             </div>
                            <input type="text" class="form-control" id="dt_nacito" name="dt_nacito" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" @isset($professor) value="{{$professor->dt_nacito}}" @endisset im-insert="false" required>
                       </div>
                      </div>
                    </div>
                  </div>
                    <label for="name">Nome</label>
                    <input type="text" name="name" id="name" class="form-control" @isset($professor) value="{{$professor->user->name}}" @endisset required>

                    <label>Habilidades</label>
                    <input type="text" class="form-control" name='habilidades' id='habilidades' @if($professor) value="{{$professor->habilidades}}" @endif required>
                   
                    <!--<label  class="control-label">Imagem</label>
                    <input type="file" name="file" id="file"  class="form-control" require><br>-->

                    <button type="submit" class="btn btn-primary btn-block mt-3"> Savlar </button>
                  </div>
                
                
                  <div class="col-md-4">
                    <div class="card" style="height: 100%;">
                    <div class="card-header border-0">
                      <h3 class="card-title"><i class="fas fa-building mr-1"></i>Unidades de atuação.</h3>
                      <!-- card tools -->
                      <div class="card-tools">
                        <button type="button" class="btn btn-primary btn-sm daterange" data-toggle="tooltip" title="Adicionar unidade" id="plus_btn">
                          <i class="fa fa-plus"></i>
                        </button>
 
                      </div>
                      <!-- /.card-tools -->
                    </div>
                    <div class="card-body" style="display: block;">
                      <div id="world-map" style="height: 250px; width: 100%;">
                    
                    


                        <table class="table table-bordered table-sm">
                            <thead>
                            <tr>
                              <th>Unidade</th>
                              <th> </th>
                              
                              
                            </tr>
                            </thead>
                            <tbody>
                              @isset($professor->unidades)
                                @foreach ($professor->unidades as $unidade)
                                   <tr>
                                     
                                    <td>{{$unidade->desc->titulo}}</td>
                                    <td class="text-center"><a href="{{route('professor-delete-unidade', $unidade->id)}}" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
                                   </tr>  
                                @endforeach
                              @endisset  
                            </tbody>
 
                          </table>


                    
                    
                    </div>
                    </div>
                    <!-- /.card-body-->
 
                  </div>

                  </div>


                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->


</div>


@include('admin.menus.modal')


@endsection


@section('scripts')
<script src="{{asset('admin/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('admin/plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
<script>
  $(function () {
    $('#dt_nacito').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });

    $("input[data-bootstrap-switch]")
    .each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });


    @isset($message)
      window.Toast.fire({
        icon: '{{$message['type']}}',
        title: ' {{$message['message']}}.'
      })
    @endisset


  });

function modal(){

  @isset($professor)   
  $('#modal').modal('show');
  $('#modal-corpo').html('loading...');
  $('#modal-titulo').html('Selecionar foto do perfil:');
  requisicao('/app/professor/foto','GET','{{$professor->id}}')
    .then(result => {
      $('#modal-corpo').html(result);
    });
  @endisset 
  @if(!$professor)
    alert('Salve os dados antes de alterar a foto');
  @endif

}

$("#plus_btn").click(function(e) {
      $('#modal').modal('show');
      $('#modal-titulo').html('Selecione a unidade:');
      requisicao("{{route('professor-form-unidade')}}",'GET','{{$id}}')
      .then(result => {
        $('#modal-corpo').html(result);
     });
       
    });

</script>
@endsection

