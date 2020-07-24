@extends('layouts.admin')

@section('estilo')

  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    
@endsection

@section('conteudo')
<div class="container-fluid">

    <br>
    <div class="card">
              <div class="card-header">
                <h3 class="card-title"></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <a href="{{route('aluno-registra')}}" class="btn btn-primary btn-block">Registrar novo aluno</a>
  

                

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->





            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Alunos Cadastrados</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="alunos_table" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>CPF</th>
                    <th>Nome</th>
                    <th>Celular</th>
                    <th>Status</th>
                    <th>E-mail</th>
                    <th> # </th>
                  </tr>
                  </thead>


                  <tbody>
                    @isset($alunos)
                    @if ($alunos)
                        @foreach ($alunos as $aluno)
                            <tr>
                              <td>{{ $aluno->cpf }}</td>
                              <td>{{ $aluno->nome }}</td>
                              <td>{{ $aluno->Celular1}}</td>
                              <td>{{ $aluno->email }}</td>
                              <td>{{ $aluno->AtivoTxt }}</td>
                              <td>@include('admin.alunos.elementos.botaoEditar')</td>
                            </tr>    
                        @endforeach
                    @endif    
                   @endisset
                    

                  </tbody>
 
                </table>
              </div>
              <!-- /.card-body -->
            </div>


</div>



<div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tem certeza que deseja excluir funcionario</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="id_del" name="id_del" value="0">
         <p id="body_modal">...</p>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">cancelar</button>
        <button type="button" class="btn btn-danger">Exluir</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


@endsection


@section('scripts')


<script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>

<script>
  $(function () {
    

    $("#alunos_table").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    
    @isset($message)
    window.Toast.fire({
        icon: '{{$message['type']}}',
        title: ' {{$message['message']}}.'
      })
    @endisset
  });

function delete_confirm(id, name){
  $('#modal-default').modal('show');
  $('#body_modal').html(name);
}

</script>

@endsection

