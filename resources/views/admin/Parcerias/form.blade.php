@extends('layouts.admin')

@section('estilo')
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('admin/plugins/summernote/summernote-bs4.css')}}">
@endsection




@section('conteudo')
<div class="container-fluid">

    <br>
    <div class="card">
              <div class="card-header">
                <h3 class="card-title">Edição de Parceiros</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <div class="col-md-12">
                    <form method="post" action="{{route('parceria-cadastro',$id)}}"  enctype="multipart/form-data">
                        {{  csrf_field() }}
                        <input type="hidden" id="id" name="id">


                    
                    <div class="row">
                        <div class="col-md-3">
                            @php
                                $img = '/img/parcerias/nofoto.png'; 
                                if($p) $img = $p->img_capa;      
                            @endphp
                            <img src="{{asset($img)}}" class="img-fluid">
                        </div>

                        <div class="col-md-9">

      

                            <div class="form-group mao">   
                                <label class="mao" for="img">Clique para selecionar foto de capa...</label>
                                <input type="file" id="img_capa" name="img_capa" class="form-control"/>
                            </div>    

                            <div class="form-group">   
                              <label>Subtitulo</label> 
                              <input type="text" name="sub_titulo" class="form-control" id="sub_titulo">
                            </div>    
        
                            <div class="form-group">   
                              <label>Titulo</label> 
                              <input type="text" name="titulo" class="form-control" id="titulo">
                            </div>    
                        </div>
                    </div>
  
                    <div class="form-group">
                      <label>Conteudo da pagina:</label>
                      <textarea id="texto" 
                                name="texto" 
                                class="form-control" 
                                style="height: 300px">
                                @isset($p){!!$p->texto!!}@endisset
                      </textarea>
                    </div>
 
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                     <button type="submit" class="btn btn-outline-primary btn-block" onclick="save()">Salvar</button>
    
              </div>

            </form>
              </div>
              <!-- /.card-footer -->
                </div> <!-- /.col-md-9 -->
            </div>
 

</div>
@endsection


@section('scripts')
<!-- Summernote   -->
<script src="{{ asset('admin/plugins/summernote/summernote-bs4.min.js')}}"></script>


<script>
    $(function () {
      @isset($p)
        $('#sub_titulo').val('{{$p->sub_titulo}}');
        $('#titulo').val('{{$p->titulo}}');
 
 
      @endisset 
      @isset($message)
      window.Toast.fire({
        icon: '{{$message['type']}}',
        title: ' {{$message['message']}}.'
      })
     @endisset

      $('#texto').summernote();
    });

    function save(){
    const aula_id = $('#aula_id').val();
    const titulo = $('#titulo').val();
    const texto = $('#texto').val();
     requisicao('/app/detalhe-aula/save','POST',aula_id,titulo,texto)
    .then(result => {
      if(result == 'saved'){
          window.Toast.fire({icon: 'success', title: ' Dados Alterados com seucesso ! '});
      }else{
        window.Toast.fire({icon: 'error', title: 'Ops algo saiu errado...'});
        console.log(result);
      }
    });
    }
  </script>
@endsection

