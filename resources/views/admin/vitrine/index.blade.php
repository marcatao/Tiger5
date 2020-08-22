@extends('layouts.admin')

@section('estilo')
<link rel="stylesheet" href="{{ asset('css/custon.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    
@endsection


@section('conteudo')
<a href="{{route('vitrine-produto')}}"  class="botao-canto bg-primary">
  <i class="fa fa-plus" aria-hidden="true"></i>
</a>  

<div class="col-md-12 mt-2">
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Produtos da Virine</h3>
    </div>
    <div class="card-body">



<table id="vitrine_produtos" class="table table-bordered table-striped table-hover">
  <thead>
  <tr>
    <th></th>
    <th>Produto</th>
    <th>Valor</th>
    <th>Desconto</th>
    <th>Ativo</th>
    <th></th>
    <th></th>
  </tr>
  </thead>


  <tbody>
    @isset($vitrines)
    @if ($vitrines)
        @foreach ($vitrines as $vitrine)
            <tr>
              <td>
                @if($vitrine->imagens)
                @foreach ($vitrine->imagens as $img)
                <img src="{{asset($img->src)}}" class="profile-user-img img-fluid">
                @break
                @endforeach
                @endif

              </td>
              <td>{{$vitrine->produto}}</td>
              <td>{{$vitrine->valor}}</td>
              <td>{{$vitrine->desconto}}</td>
              <td>{{$vitrine->Status}}</td>
              <td><a href="{{route('vitrine-produto-edit',$vitrine->id)}}" class="btn btn-primary"> Editar </a></td>
              <td><a href="{{route('vitrine-produto-delete',$vitrine->id)}}"class="btn btn-danger"> excluir </a></td>

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
    $("#vitrine_produtos").DataTable({
        "responsive": true,
        "autoWidth": false,
      });
  });



$("#btn_carrega").click(function() {
 $('#relatorios-aniversarios').html('Loading...');
 const data = prepara_data();
 console.log(data);
 requisicao("{{route('relatorios-aniversarios')}}",'post', data)
      .then(result => {
        $('#relatorios-aniversarios').html(result);
     });
});

</script>
@endsection