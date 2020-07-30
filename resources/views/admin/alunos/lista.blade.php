@extends('layouts.admin')

@section('estilo')

  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    
@endsection

@section('conteudo')
<div class="container-fluid">

    <br>
 
       
                  <a href="{{route('aluno-registra')}}" class="btn btn-primary btn-block mb-3">Registrar novo aluno</a>
  

  




            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Alunos Cadastrados</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                

                        <!-- ./row -->
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary card-tabs">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Ativos</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false" onclick="tabInativo()">Inativos</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                     Loading
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab"></div>
     
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
          
        </div>


              </div>
              <!-- /.card-body -->
            </div>


</div>



@include('admin.menus.modal')
@endsection


@section('scripts')


<script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>

<script>
  $(function () {
    chama_lista('1','custom-tabs-one-home');
    
    @isset($message)
    window.Toast.fire({
        icon: '{{$message['type']}}',
        title: ' {{$message['message']}}.'
      })
    @endisset
  });

function tabela(id){
  $("#"+id).DataTable({
      "responsive": true,
      "autoWidth": false,
    });
}

function tabInativo(){
  chama_lista('0','custom-tabs-one-profile');
}
function chama_lista(id,tab){
  requisicao('/app/table/'+id,'GET')
    .then(result => {
        $("#"+tab).html(result);
    });
}

function ativo(id,status){

  requisicao('/app/aluno/ativo','POST',id,status)
    .then(result => {
      $('#linha_'+id).hide('slow');
      window.Toast.fire({icon: 'success', title: 'Registro com sucesso!'});
    });
}



function del(id){
    
  $('#modal').modal('show');
  $('#modal-corpo').html('loading...');
  $('#modal-titulo').html('Tem certeza que deseja deletar?');
  requisicao('/app/aluno/deleta','GET',id)
    .then(result => {
      $('#modal-corpo').html(result);
    });
  
}
</script>

@endsection

