@extends('layouts.admin')

@section('estilo')

  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    
@endsection

@section('conteudo')
<div class="container-fluid">
 
  <a href="{{route('create-login')}}" class="btn btn-primary btn-block mb-2 mt-2">Novo Login</a>

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Logins do sistema</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="alunos_table" class="table table-bordered table-striped">
                  <thead>
                  <tr>
               
                    <th>Nome</th>
                    <th>Login</th>
                    <th>Profile</th>
                    <th> # </th>
                  </tr>
                  </thead>


                  <tbody>
                    @isset($logins)
                    @if ($logins)
                        @foreach ($logins as $login)
                            <tr>
                              <td>{{ $login->name }}</td>
                              <td>{{ $login->email }}</td>
                              <td>{{ $login->profile->desc }}</td>
                              <td><a href="{{route('edit-login',$login->id)}}" class="btn btn-primary btn-block">Editar</a></td>
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
</script>
@endsection

