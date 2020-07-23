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
                <h3 class="card-title">Edição detalhe da Aula</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <div class="col-md-12">
                  
                    <input type="hidden" value="{{$aula_detalhe->aula_id}}" id="aula_id" name="aula_id">
                             <!-- /.col -->
                 <div class="form-group">   
                     <label>Titulo</label> 
                    <input type="text" name="titulo" class="form-control" id="titulo" value="{{$aula_detalhe->titulo}}">
                 </div>    
  
                <div class="form-group">
                    <label>Conteudo da pagina:</label>
                    <textarea id="texto" name="texto" class="form-control" style="height: 300px">
                     {{$aula_detalhe->texto}}
                    </textarea>
                </div>
 
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  
                     <a class="btn btn-outline-primary btn-block" onclick="save()">Salvar</a>
                     <a class="btn btn-outline-alert btn-block" >Ver como esta ficando...</a>
              </div>
 
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

