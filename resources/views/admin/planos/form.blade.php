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
                <h3 class="card-title">Edição de Planos</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <div class="row">
                <div class="col-md-7">

              @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif          

                <form method="post" action="{{route('form-planos',$id)}}">
                    {{  csrf_field() }}
                    <label>Titulo do plano</label>
                    <input type="text" class="form-control mb-3" name='titulo_plano' id='titulo_plano' @isset($plano) value="{{$plano->titulo_plano }}" @endisset>
                    
                    <label>Descrição do plano</label>
                    <textarea class="form-control mb-3" id="desc_plano" name="desc_plano"> @isset($plano) {{$plano->desc_plano }} @endisset</textarea>
               <div class="row">
                   <div class="col-md-6">
                        <label>Vigência do plano (em dias)</label>
                        <input type="number" class="form-control mb-3" name='duracao_dias' id='duracao_dias' @isset($plano) value="{{$plano->duracao_dias }}" @endisset>
                   </div> 
                   <div class="col-md-6">
                         <label>Valor do plano</label>
                         <input type="text" class="form-control mb-3" name='valor_plano' id='valor_plano' @isset($plano) value="{{$plano->valor_plano }}" @endisset>
                   </div> 
                  </div> <!--close row -->   
                   <div class="row mb-5">
                       <div class="col-md-6">
                         @php
                             $visivel_site = '';
                             $visivel_valor = '';
                             if($plano){
                              if($plano->visivel_site == 1) $visivel_site = 'checked'; 
                              if($plano->visivel_valor == 1) $visivel_valor = 'checked';
                             }
                         @endphp
                             <label>Exibir este plano no site?</label><br>
                              <input type="checkbox" 
                                     data-on-text="Sim"  
                                     data-off-text="Não"  
                                     data-bootstrap-switch 
                                     name="visivel_site" 
                                     id="visivel_site"
                                     class="mb-5 mt-3"
                                    {{$visivel_site}}  
                               >
                       </div> 
                       <div class="col-md-6">
                        <label>Exibir valor do plano no site?</label><br>
                        <input type="checkbox" 
                               data-on-text="Sim"  
                               data-off-text="Não"  
                               data-bootstrap-switch 
                               name="visivel_valor" 
                               id="visivel_valor"
                               class="mb-5 mt-3"
                              {{$visivel_valor}}  
                         >
                       </div>                

                   </div>

                  
                    
                                  
                    <button type="submit" class="btn btn-primary btn-block mb-3"> Savlar </button>
                    <a href="{{route('cadastro-planos')}}" class="btn btn-outline-warning btn-block">Voltar</a>
                </form>   
            </div>  
                <div class="col-md-5">

                <div class="card" style="height: 100%;">
                    <div class="card-header border-0">
                      <h3 class="card-title">
                        <i class="fas fa-boxes mr-1"></i>
                        Aulas do plano
                      </h3>
                      <!-- card tools -->
                      <div class="card-tools">
                        <button type="button" class="btn btn-primary btn-sm daterange" data-toggle="tooltip" title="Adicionar Aula" id="plus_btn">
                          <i class="fa fa-plus"></i>
                        </button>
 
                      </div>
                      <!-- /.card-tools -->
                    </div>
                    <div class="card-body" style="display: block;">
                      <div id="world-map" style="height: 250px; width: 100%;">
                    
                    


                        <table id="example1" class="table table-bordered table-sm">
                            <thead>
                            <tr>
                              <th>Aula</th>
                              <th>Quantidade</th>

                              <th> </th>
 
                              
                            </tr>
                            </thead>
                            <tbody>
                              @isset($plano)
                              @foreach ($plano->aulas as $aulas)
                                  <tr>
                                      <td>{{$aulas->aula->desc}}</td>
                                      <td>{{$aulas->qtd_aulas}}</td>
                                  <td class="text-center"><a href="{{route('delete-aula-do-plano',$aulas->id)}}" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
                                  </tr>
                              @endforeach
                              @endisset
                           
                            </tbody>
 
                          </table>


                    
                    
                    </div>
                    </div>
                    <!-- /.card-body-->
 
                  </div>
                </div><!-- /.fecha coluna -->


                </div>    <!-- /.fecha row -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->


</div>

@include('admin.menus.modal');

@endsection

@section('scripts')
<script src="{{asset('admin/plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script> 
<script src="{{asset('admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
<script>
    $(function () {
      
      $("input[data-bootstrap-switch]").each(function(){
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
      });



      @isset($message)
        window.Toast.fire({
          icon: '{{$message['type']}}',
          title: ' {{$message['message']}}.'
        })
      @endisset

        $('#valor_plano').inputmask('decimal', {
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

    $("#plus_btn").click(function(e) {
      $('#modal').modal('show');
      $('#modal-titulo').html('Aula e quantidades para este plano:');
      requisicao("{{route('aulas-plano')}}",'GET','{{$id}}')
      .then(result => {
        $('#modal-corpo').html(result);
     });
       
    });
  </script>

@endsection


