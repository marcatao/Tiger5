@extends('layouts.admin')


@section('conteudo')
<div class="container-fluid">

    <br>
    <div class="card">
              <div class="card-header">
                <h3 class="card-title">Edição nome da Aula</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <form method="post" action="{{route('form-aula',$id)}}">
                    {{  csrf_field() }}
                    <input type="hidden" value="{{$id}}" id="id" name="id">
                    <label> Nome da aula </label>
                    <input type="text" class="form-control" name='desc' id='desc' @if($aula) value="{{$aula->desc}}" @endif required>
                
                @php
                    $checked="";
                    if($aula->ativo==1)$checked="checked";
                @endphp
         
                  <label class="mt-3"> Ativo </label><br>
                  <input type="checkbox" 
                         data-on-text="Ativo"  
                         data-off-text="Inativo"  
                         data-bootstrap-switch 
                         name="ativo" 
                         id="{{$aula->id}}"
                         {{$checked}}
                  ><br>
            
             
                    <label class="mt-3">Resumo</label>
                    <textarea class="form-control" id="resumo" name="resumo">@if($aula) {{$aula->resumo}} @endif </textarea><br>
                    <button type="submit" class="btn btn-primary btn-block"> Savlar </button>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->


</div>


@endsection

@section('scripts')
<script src="{{asset('admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>

<script>
  $(function () {

    $("input[data-bootstrap-switch]").each(function(){
          $(this).bootstrapSwitch('state', $(this).prop('checked'));
      }).on('switchChange.bootstrapSwitch', function (event, state) {
          trocaAluno($(this).prop('checked'),this.id);
      }); ;
  });

  function trocaAluno(st,id){
    requisicao('{{route('cadastro-aula-ativa')}}','post',id,st)
    .then(result => {
        console.log(id,st);
        window.Toast.fire({icon: 'success', title: 'Dados Alterados'});
        console.log(result)
    });
    }
</script>

@endsection