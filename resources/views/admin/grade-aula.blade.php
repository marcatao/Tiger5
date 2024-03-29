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
 
                    <th>Aula</th>
                    <th>Dia</th>
                    <th>Professor</th>
                    <th>Unidade</th>
                    <th>Inicio</th>
                    <th>Fim</th>
                    <th>Dispon.</th>
                    <th>Alunos</th>
                    <th> </th>
                    <th> </th>
                    
                  </tr>
                  </thead>
                  <tbody>
                
                        @foreach ($grades as $grade)
                            <tr id="row_{{$grade->id}}">
                  
                                <td>{{$grade->aula->desc}}</td>       
                                <td>{{$grade->dia}}</td>
                                <td>
                                  @if($grade->professor)
                                  {{$grade->professor->user->shortName}}
                                  @endif
                                </td>
                                <td>@if($grade->unidade) {{$grade->unidade->titulo}} @endif</td>
                                <td>{{$grade->hora_ini}}</td>
                                <td>{{$grade->hora_fim}}</td>
                                <td>{{$grade->status->descricao}}</td>
                                <td>
                                  {{ App\grade_aluno::where('gradeAula_id',$grade->id)->count()}}
                                  
                                </td>
                                <td><a href="{{ route('form-grade',$grade->id) }}"class="btn btn-primary">Editar</a></td>         
                                <td><!--<a href="{{ route('deleta-grade',$grade->id) }}"class="btn btn-danger">Deletar</a>-->
                                  <button class="btn btn-danger" onclick=deletar_grade({{ $grade->id}})>Deletar</button>
                                </td> 
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
  </script>

@endsection


