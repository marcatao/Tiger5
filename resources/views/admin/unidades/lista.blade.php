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
                <h3 class="card-title">Unidades da academia</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

              <a href="{{ route('unidade-form',0)}}" class="btn btn-primary btn-block">Nova Unidade<a><br>

                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Titulo</th>
                    <th>Sub Titulo</th>
                    <th>End1</th>
                    <th>End2</th>
                    <th>End3</th>
                    <th>Whats</th>
                    <th>Responsavel</th>
                    <th>Instagran</th>
                    <th> </th>
                    <th> </th>
                    
                  </tr>
                  </thead>
                  <tbody>
                        @foreach ($unidades as $unidade)
                             <tr>
                                 <td>{{$unidade->titulo}}</td>
                                 <td>{{$unidade->sub_titulo}}</td>
                                 <td>{{$unidade->end1}}</td>
                                 <td>{{$unidade->end2}}</td>
                                 <td>{{$unidade->end3}}</td>
                                 <td>{{$unidade->whats}}</td>
                                 <td>{{$unidade->responsavel}}</td>
                                 <td>{{$unidade->insta}}</td>
                                 <td><a href="{{route('unidade-form',$unidade->id)}}" class="btn btn-primary btn-block"> Editar </a></td>
                                 <td><a href="{{route('unidade-del',$unidade->id)}}" class="btn btn-danger btn-block"> Deletar </a></td>
                               
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