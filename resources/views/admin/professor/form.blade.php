@extends('layouts.admin')


@section('conteudo')
<div class="container-fluid">

    <br>
    <div class="card">
              <div class="card-header">
                <h3 class="card-title">Edição Professor</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                @php   $fotoPerfil = '/admin/profiles/nofoto.png'   @endphp
                @isset($professor)
                  @php   $fotoPerfil = $professor->FotoPerfil;   @endphp
                @endisset


                <div class="row">
                  <div class="col-md-2 text-center">

   
                  <label>Foto do perfil:</label>
                  <a href="#" alt="clique para alterar foto" onclick="modal()">
                  <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle  elevation-2" src="{{asset($fotoPerfil)}}" alt="User profile picture">
                    <p class="text-center"> Alterar Foto </p>
                  </div>
                  
                  </a>
           

              </div>
            <div class="col-md-6">
                  <form method="post" action="{{route('form-professor',$id)}}"  enctype="multipart/form-data">
                    {{  csrf_field() }}
                    <input type="hidden" value="{{$id}}" id="id" name="id">

                    <div class="row">
                    <div class="col-md-8">
                     <label for="email">Email</label>
                      <input type="email" 
                              name="email" 
                              id="email" 
                              class="form-control" 
                              placeholder="fulano@email.com..."
                              required>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Data Nascimento</label>
                        <div class="input-group">
                             <div class="input-group-prepend">
                               <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                             </div>
                            <input type="text" 
                                   class="form-control" 
                                   id="dt_nacito" 
                                   name="dt_nacito" 
                                   data-inputmask-alias="datetime" 
                                   data-inputmask-inputformat="dd/mm/yyyy" 
                                   data-mask="" 
                                   placeholder="dd/mm/aaaa" 
                                   im-insert="false" 
                                   required>
                       </div>
                      </div>
                    </div>
                  </div>
                    <label for="name">Nome</label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           class="form-control" 
                           placeholder="Nome do professor" 
                           required>

                    <label>Apresentação</label>
                    <input type="text" 
                           class="form-control" 
                           name='habilidades' 
                           id='habilidades'
                           placeholder="Ex... Grande mestre artes marciais" 
                           required>
                   

                    <div class="row">
                      <div class="col-md-4">
                         <div class="form-group">
                            <label for=>CPF</label>
                            <input type="text" 
                                   class="form-control" 
                                   id="cpf" 
                                   name="cpf" 
                                   placeholder="Informe CPF..." 
                                   required>
                         </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">RG</label>
                              <input type="text" 
                                     class="form-control" 
                                     id="rg" 
                                     name="rg" 
                                     placeholder="Informe o RG... (opcional)">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                            <label>Sexo</label>
                             <select class="form-control" name="sexo" id="sexo">
                                 <option value="Masculino">Masculino</option>
                                 <option value="Feminino">Feminino</option>
                                 <option value="Indefinido">Indefinido</option>
                             </select>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                       <div class="col-md-4">
                          <label for="exampleInputEmail1">Operadora</label>
                          <select class="form-control" id="operadora1" name="operadora1">
                              @include('admin.operadoras')
                          </select>
                        </div> 
                        <div class="col-md-8"> 
                          <label>Celular</label>
                          <input type="text" 
                                 class="form-control" 
                                 id="cel1" 
                                 name="cel1" 
                                 placeholder="Celular 1 (opcional)">
                        </div>  
                      </div>

                   <div class="row">   
                    <div class="col-md-4">
                        <label for="exampleInputEmail1">Operadora</label>
                        <select class="form-control" id="operadora2" name="operadora2">
                          @include('admin.operadoras')
                        </select>
                      </div> 
                      <div class="col-md-8"> 
                        <label>Celular 2</label>
                        <input type="text" 
                               class="form-control" 
                               id="cel2" 
                               name="cel2" 
                               placeholder="Celular 2 (opcional)">
                      </div>  
                    </div>




                    <hr>
     
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>CEP</label>
                          <input type="text" 
                                 class="form-control" 
                                 id="cep" 
                                 name="cep" 
                                 placeholder="CEP.. (opcional)" 
                                 >
                      </div>   
                      </div>
                      <div class="col-md-8">
                        <div class="form-group">
                          <label >Rua</label>
                          <input type="text" 
                                 class="form-control" 
                                 id="rua" 
                                 name="rua" 
                                 placeholder="rua.. (opcional)">
                          </div>   
                      </div>

                    </div><!--fecha row -->
  
                    <div class="row">
                     
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Numero</label>
                          <input type="text" 
                                 class="form-control" 
                                 id="numero" 
                                 name="numero" 
                                 placeholder="numero.. (opcional)" 
                                 >
                      </div>  
                      </div>
                
                      <div class="col-md-7">
                        <div class="form-group">
                          <label>Complemento</label>
                          <input type="text" 
                                 class="form-control" 
                                 id="complemento" 
                                 name="complemento" 
                                 placeholder="complemento.. (opcional)" 
                                 >
                      </div> 
                      </div>

                      <div class="col-md-2">
                        <div class="form-group">
                          <label>UF</label>
                         <select name="estado" id="estado" class="form-control">
                          <option value="SP"> SP</option><option value="AC"> AC</option>
                          <option value="AL"> AL</option>
                          <option value="AP"> AP</option>
                          <option value="AM"> AM</option>
                          <option value="BA"> BA</option>
                          <option value="CE"> CE</option>
                          <option value="DF"> DF</option>
                          <option value="ES"> ES</option>
                          <option value="GO"> GO</option>                     
                          <option value="MA"> MA</option>
                          <option value="MT"> MT</option>
                          <option value="MS"> MS</option>
                          <option value="MG"> MG</option>
                          <option value="PA"> PA</option>
                          <option value="PB"> PB</option>
                          <option value="PR"> PR</option>
                          <option value="PE"> PE</option>
                          <option value="PI"> PI</option>
                          <option value="RJ"> RJ</option>
                          <option value="RN"> RN</option>
                          <option value="RS"> RS</option>
                          <option value="RO"> RO</option>
                          <option value="RR"> RR</option>
                          <option value="SC"> SC</option>
                          <option value="SE"> SE</option>
                          <option value="TO"> TO</option>
                         </select>
                      </div>
                    </div>



                    </div> <!-- fecha row 2-->

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Bairro</label>
                          <input type="text" 
                                 class="form-control" 
                                 id="bairro" 
                                 name="bairro" 
                                 placeholder="bairro.. (opcional)"
                                 >
                      </div>      
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Cidade</label>
                          <input type="text" 
                                 class="form-control" 
                                 id="cidade" 
                                 name="cidade" 
                                 placeholder="cidade.. (opcional)"
                                 >
                      </div>  
                      </div>
                    </div>
                    

                    <button type="submit" class="btn btn-primary btn-block mt-3"> Savlar </button>
                  </div>
                
                
                  <div class="col-md-4">
                    <div class="card">
                    <div class="card-header border-0">
                      <h3 class="card-title"><i class="fas fa-building mr-1"></i>Unidades de atuação.</h3>
                      <!-- card tools -->
                      <div class="card-tools">
                        <button type="button" class="btn btn-primary btn-sm daterange" data-toggle="tooltip" title="Adicionar unidade" id="plus_btn">
                          <i class="fa fa-plus"></i>
                        </button>
 
                      </div>
                      <!-- /.card-tools -->
                    </div>
                    <div class="card-body" style="display: block;">
                      <div id="world-map" style="width: 100%;">
                        <table class="table table-bordered table-sm">
                            <thead>
                            <tr>
                              <th>Unidade</th>
                              <th> </th>
                            </tr>
                            </thead>
                            <tbody>
                              @isset($professor->unidades)
                                @foreach ($professor->unidades as $unidade)
                                   <tr>
                                    <td>{{$unidade->desc->titulo}}</td>
                                    <td class="text-center"><a href="{{route('professor-delete-unidade', $unidade->id)}}" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
                                   </tr>  
                                @endforeach
                              @endisset  
                            </tbody>
                          </table>
                    </div>
                    </div>
                    <!-- /.card-body-->
                  </div>



                  <div class="card">
                    <div class="card-header border-0">
                      <h3 class="card-title"><i class="fas fa-boxes mr-1"></i>Aulas do professor</h3>
                      <!-- card tools -->
                      <div class="card-tools">
                        <button type="button" class="btn btn-primary btn-sm daterange" data-toggle="tooltip" title="Adicionar aulas ao professor" id="plus_btn_professor">
                          <i class="fa fa-plus"></i>
                        </button>
 
                      </div>
                      <!-- /.card-tools -->
                    </div>
                    <div class="card-body" style="display: block;">
                      <div id="world-map" style="width: 100%;">
                        <table class="table table-bordered table-sm">
                            <thead>
                            <tr>
                              <th>Modalidades</th>
                              <th> </th>
                            </tr>
                            </thead>
                            <tbody>
                              @isset($professor->aulas)
                                @foreach ($professor->aulas as $aula)
                                   <tr>
                                    <td>{{$aula->aula->desc}}</td>
                                    <td class="text-center"><a href="{{route('professor-delete-aula', $aula->id)}}" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
                                   </tr>  
                                @endforeach
                              @endisset  
                            </tbody>
                          </table>
                    </div>
                    </div> 
                    <!-- /.card-body-->
                  </div>




                  </div>










                  


                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->


</div>


@include('admin.menus.modal')


@endsection


@section('scripts')
<script src="{{asset('admin/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('admin/plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
<script>
  $(function () {
    preecheFormulario();

        $('#dt_nacito').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
        $('#created_at').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
        $('#cpf').inputmask({ mask: ['999.999.999-99'], keepStatic: true });
        $('#cel1').inputmask({ mask: ['(99) 99999-9999'], keepStatic: true });
        $('#cel2').inputmask({ mask: ['(99) 99999-9999'], keepStatic: true });
        $('#tel').inputmask({ mask: ['(99) 9999-9999'], keepStatic: true });


    @isset($message)
      window.Toast.fire({
        icon: '{{$message['type']}}',
        title: ' {{$message['message']}}.'
      })
    @endisset


  });



function preecheFormulario(){
  @isset($professor)  
          $('#habilidades').val('{{$professor->habilidades}}');
          $('#dt_nacito').val('{{$professor->DtNascitoBr}}');
          $('#cpf').val('{{$professor->cpf}}');        
          $('#rg').val('{{$professor->rg}}');        
          $('#sexo').val('{{$professor->sexo}}');       
          $('#tel').val('{{$professor->tel}}');        
          $('#cel1').val('{{$professor->cel1}}');       
          $('#operadora1').val('{{$professor->operadora1}}'); 
          $('#cel2').val('{{$professor->cel2}}');       
          $('#operadora2').val('{{$professor->operadora2}}'); 
          $('#cep').val('{{$professor->cep}}');        
          $('#rua').val('{{$professor->rua}}');        
          $('#numero').val('{{$professor->numero}}');     
          $('#bairro').val('{{$professor->bairro}}');     
          $('#cidade').val('{{$professor->cidade}}');     
          $('#estado').val('{{$professor->estado}}');     
          $('#complemento').val('{{$professor->complemento}}');
      @isset($user)
            $('#email').val('{{$user->email}}');  
            $('#name').val('{{$user->name}}');  
      @endisset
   @endisset
}


function modal(){

  @isset($professor)   
  $('#modal').modal('show');
  $('#modal-corpo').html('loading...');
  $('#modal-titulo').html('Selecionar foto do perfil:');
  requisicao('/app/professor/foto','GET','{{$professor->id}}')
    .then(result => {
      $('#modal-corpo').html(result);
    });
  @endisset 
  @if(!$professor)
    alert('Salve os dados antes de alterar a foto');
  @endif

}

$("#plus_btn").click(function(e) {
      $('#modal').modal('show');
      $('#modal-titulo').html('Selecione a unidade:');
      requisicao("{{route('professor-form-unidade')}}",'GET','{{$id}}')
      .then(result => {
        $('#modal-corpo').html(result);
     });
});

$("#plus_btn_professor").click(function(e) {
      $('#modal').modal('show');
      $('#modal-titulo').html('Selecione uma modalidade:');
      requisicao("{{route('professor-form-aula')}}",'GET','{{$id}}')
      .then(result => {
        $('#modal-corpo').html(result);
     });
});    



    function limpa_formulário_cep(){
    $("#rua").val("");
    $("#bairro").val("");
    $("#cidade").val("");
    $("#estado").val("");
}

$("#cep").blur(function() {
    var cep = $(this).val().replace(/\D/g, '');
    if (cep != "") {
        var validacep = /^[0-9]{8}$/;
        if(validacep.test(cep)) {
            $("#rua").val("...");
            $("#bairro").val("...");
            $("#cidade").val("...");
            $("#estado").val("...");
          $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {
            if (!("erro" in dados)) {
                $("#rua").val(dados.logradouro);
                $("#bairro").val(dados.bairro);
                $("#cidade").val(dados.localidade);
                $("#estado").val(dados.uf);
            }
            else {
                limpa_formulário_cep();
                alert("CEP não encontrado.");
            }
        });
    }
    else {
        //cep é inválido.
        limpa_formulário_cep();
        alert("Formato de CEP inválido.");
    }
}
else {
    limpa_formulário_cep();
}
});
</script>
@endsection

