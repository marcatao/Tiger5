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
                <h3 class="card-title">Aulas disponiveis para minha academia</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

              <a href="{{ route('form-grade',0)}}" class="btn btn-primary btn-block">Adicionar Grade de aula<a><br>

                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#id</th>
                    <th>Aula</th>
                    <th>Dia</th>
                    <th>Professor</th>
                    <th>Inicio</th>
                    <th>Fim</th>
                    <th> </th>
                    <th> </th>
                    
                  </tr>
                  </thead>
                  <tbody>
                
                        @foreach ($grades as $grade)
                            <tr>
                                <td>{{$grade->id}}</td> 
                                <td>{{$grade->aula->desc}}</td>       
                                <td>{{$grade->dia}}</td>
                                <td>
                                  @if($grade->professor)
                                  {{$grade->professor->user->name}}
                                  @endif
                                </td>
                                <td>{{$grade->hora_ini}}</td>
                                <td>{{$grade->hora_fim}}</td>
                               
                                <td><a href="{{ route('form-grade',$grade->id) }}"class="btn btn-primary">Editar</a></td>         
                                <td><a href="{{ route('deleta-grade',$grade->id) }}"class="btn btn-danger">Deletar</a></td> 
                            </tr>
                        @endforeach
                 
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>#id</th>
                    <th>Aula</th>
                    <th>Dia</th>
                    <th>Professor</th>
                    <th>Inicio</th>
                    <th>Fim</th>
                    <th> </th>
                    <th> </th>
                  </tr>
                  </tfoot>
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
  </script>
@endsection


