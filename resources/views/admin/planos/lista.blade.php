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
                <h3 class="card-title">Planos cadastrados</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

              <a href="{{ route('form-planos',0)}}" class="btn btn-primary btn-block">novo plano<a><br>

                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Plano</th>
                    <th>Prazo</th>
                    <th>QTD Aulas</th>
                    <th>Valor</th>
                    <th>Exibe no site</th>
                    <th> </th>
                    <th> </th>
                    
                  </tr>
                  </thead>
                  <tbody>

                    @foreach ($planos as $plano)
                        <tr id="row_{{$plano->id}}">
                          <td>{{$plano->titulo_plano}}</td>
                          <td>{{$plano->duracao_dias}} dias</td>
                          <td>{{$plano->aulas->sum('qtd_aulas')}}</td>
                          <td>{{$plano->valor_plano}}</td>
                          <td>@if($plano->visivel_site)
                                Sim
                              @else 
                                Não
                              @endif
                          </td>
                          
                          <td><a href="{{ route('form-planos',$plano->id) }}"class="btn btn-primary">Editar</a></td>
                          <td><button class="btn btn-danger" onclick=deletar_plano({{$plano->id}})>Deletar</button></td>
                        </tr>
                    @endforeach
 
                 
                  </tbody>
 
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->


</div>
@endsection

@section('scripts')
<!-- DataTables -->
<script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
      });
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  
  function  deletar_grade(id){
    requisicao('/app/deleta-grade/'+id,'POST')
    .then(result => {
      if(result == 'deleted'){
          window.Toast.fire({icon: 'success', title: 'Grade deletada com sucesso!'});
          $('#row_'+id).hide('slow');
      }else{
        window.Toast.fire({icon: 'error', title: 'Ops algo saiu errado...'});
        console.log(result)
      }
    });
  }
  function  deletar_plano(id){
    requisicao('/app/deleta-plano/'+id,'POST')
    .then(result => {
      if(result == 'deleted'){
          window.Toast.fire({icon: 'success', title: 'Plano deletado com sucesso!'});
          $('#row_'+id).hide('slow');
      }else{
        window.Toast.fire({icon: 'error', title: 'Ops algo saiu errado...'});
        console.log(result)
      }
    });
  }
  </script>

@endsection


