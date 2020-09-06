@extends('layouts.admin')

@section('estilo')
@endsection

@section('conteudo')
<div class="col-md-12 mt-2">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Cadastro de produto</h3>
      </div>
      <div class="card-body">
 
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif



        <div class="row">
            <div class="col-md-3">
                <label>Imagens do produto</label>
                <button class="btn btn-block btn-default" onclick="modal()">Adicionar Imagem</button>
                @isset($vitrine)
                @foreach ($vitrine->imagens as $img)
                    <div class="row mt-1">
                        <div class="col-md-8">
                            <img src="{{asset($img->src)}}" class="profile-user-img img-fluid">
                        </div>
                        <div class="col-md-1">
                            <a href="{{route('vitrine-imagem-delete',$img->id)}}"class="btn btn-danger mr-5 mt-2"><i class="fas fa-trash"></i></a>
                        </div>
                    </div>
                    @endforeach
                  @endisset
         </div>

        <div class="col-md-6">
            <form method="post" action="{{route('vitrine-produto')}}"> 
                {{  csrf_field() }} 
            <input type="hidden" value="0" name="id" id="id">
             <label>Titulo do Produto</label>
             <input type="text" class="form-control" name="produto" id="produto" placeholder="Titulo do produto" required>

             <label>Detalhes do produto</label>
             <textarea rows="7" 
                       class="form-control" 
                       name="descritivo" 
                       id="descritivo">@isset($vitrine){!!$vitrine->descritivo!!}@endisset
              </textarea>
        </div>
        <div class="col-md-3">

            <label>Produto ativo</label><br>
            <select name="ativo" id="ativo" class="form-control">
                <option value="1">Exibir no website</option>
                <option value="0">Não exibir no website</option>
            </select>
 
            <label class="mt-2">Valor</label>
            <input type="text" class="form-control" name="valor" id="valor" placeholder="99,99" required>
            <!--
            <label>Valor com desconto</label>
            <input type="text"   class="form-control" name="desconto" id="desconto" placeholder="99,99" required>
            -->
            <label>Exibir valor do produto</label><br>
            <select name="exibe_valor" id="exibe_valor" class="form-control">
                <option value="1">Sim, exibir valor do produto</option>
                <option value="0">Não, exibir valor do produto</option>
            </select>


        </div>
      </div>   

      <button type="submit" class="btn btn-block btn-primary mt-4">Salvar</button>
      <a href="{{route('vitrine')}}" class="btn btn-block btn-default mt-4">Voltar</a>
        </form>
      </div>
    </div>
</div>

@include('admin.menus.modal')
@endsection

@section('scripts_')
<script src="{{asset('admin/plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
<script src="{{asset('admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
<script src="{{ asset('admin/plugins/summernote/summernote-bs4.min.js')}}"></script>


<script>
 $(function () {
  $('#descritivo').summernote({
    toolbar: [
        //[groupname, [button list]]

        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['color', ['color']],
        
        
    ]
  });

    @isset($vitrine)
      $('#id').val('{{$vitrine->id}}');
      $('#produto').val('{{$vitrine->produto}}');
      
      $('#ativo').val('{{$vitrine->ativo}}');
      $('#valor').val('{{$vitrine->valor}}');
      //$('#desconto').val('{{$vitrine->desconto}}');
      $('#exibe_valor').val('{{$vitrine->exibe_valor}}');
    @endisset   


    @isset($message)
      window.Toast.fire({
        icon: '{{$message['type']}}',
        title: ' {{$message['message']}}.'
      })
    @endisset
    
    $('#valor').inputmask('decimal', {
                'alias': 'numeric',
                'groupSeparator': ',',
                'autoGroup': true,
                'digits': 2,
                'radixPoint': ".",
                'digitsOptional': false,
                'allowMinus': false,
                'placeholder': ''
         });

});

function modal(){

@isset($vitrine)
console.log('Chamou');
  $('#modal').modal('show');
  $('#modal-corpo').html('loading...');
  $('#modal-titulo').html('Selecionar foto do produto:');
  requisicao('{{route('vitrine-imagem-edit')}}','get','{{$vitrine->id}}')
    .then(result => {
      $('#modal-corpo').html(result);
    });
  @endisset 
  @if(!$vitrine)
    alert('Salve os dados antes de alterar a foto');
  @endif

}
</script>
@endsection