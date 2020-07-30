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
                <h3 class="card-title">Professores disponiveis para minha academia</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

              <a href="{{ route('form-professor',0)}}" class="btn btn-primary btn-block">Adicionar Professor<a><br>

                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th> </th>
                    <th>Nome</th>
                    <th>Habilidades</th>
             
                    <th> </th>
                    <th> </th>
                    
                  </tr>
                  </thead>
                  <tbody>
                
                        @foreach ($professores as $professor)
                            <tr>
                                <td><img src="{{asset($professor->foto)}}" class="profile-user-img img-fluid"></td>
                           
                                <td>{{$professor->user->name}}</td>
                                <td>{{$professor->habilidades}}</td>
                                
                               
                                <td><a href="{{ route('form-professor',$professor->id) }}"class="btn btn-primary">Editar</a></td>         
                                <td><a href="{{ route('deleta-professor',$professor->id) }}"class="btn btn-danger">Deletar</a></td> 
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
      
      @isset($message)
        window.Toast.fire({
          icon: '{{$message['type']}}',
          title: ' {{$message['message']}}.'
        })
      @endisset

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
  </script>
@endsection