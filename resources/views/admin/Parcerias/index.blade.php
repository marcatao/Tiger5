@extends('layouts.admin')

@section('estilo')
<link rel="stylesheet" href="{{ asset('css/custon.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    
@endsection


@section('conteudo')
<a href="{{route('parceria-cadastro',0)}}"  class="botao-canto bg-primary">
  <i class="fa fa-plus" aria-hidden="true"></i>
</a>  

<div class="col-md-12 mt-2">
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Parcerias cadastradas</h3>
    </div>
    <div class="card-body">



<table id="vitrine_produtos" class="table table-bordered table-striped table-hover">
  <thead>
  <tr>
    <th>ordem</th>
    <th></th>
    <th>SubTitulo</th>
    <th>Titulo</th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
  </tr>
  </thead>


  <tbody>
    @isset($parcerias)
    @if ($parcerias)
        @foreach ($parcerias as $p)
            <tr>
              <td>{{$p->id}}</td>
              <td>
                @if($p->img_capa)
                <img src="{{asset($p->img_capa)}}" class="profile-user-img img-fluid">
                @endif

              </td>
              <td>{{$p->sub_titulo}}</td>
              <td>{{$p->titulo}}</td>
              <td>
                @if (!$loop->first)
                  <a href="#" onclick="changeOrdem('{{$p->id}}','up')" class="btn  btn-warning "> <i class="fas fa-arrow-up"></i></a>
                @endif
              </td>
              <td>
                @if(!$loop->last)
                  <a href="#"  onclick="changeOrdem('{{$p->id}}','down')" class="btn  btn-warning "> <i class="fas fa-arrow-down"></i></a>
                @endif
              </td>
              <td><a href="{{route('parceria-cadastro',$p->id)}}" class="btn btn-primary"> Editar </a></td>
              <td><a href="{{route('parceria-delete',$p->id)}}"class="btn btn-danger"> excluir </a></td>

            </tr>  
        @endforeach
    @endif    
   @endisset
    

  </tbody>

</table>


</div></div></div>

@endsection



@section('scripts')
<script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>


<script>
  $(function () {
    //$("#vitrine_produtos").DataTable({
    //    "responsive": true,
    //    "autoWidth": false,
    //  });
  });



 
function changeOrdem(id,action){
 requisicao("{{route('parceria-ordem')}}",'get', id, action)
      .then(result => {
         location.reload();
     });
}

</script>
@endsection