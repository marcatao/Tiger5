@section('conteudo')
@php   
    $fotoPerfil = '/admin/profiles/nofoto.png';   
    $checked = 'checked';
@endphp
@isset($aluno)
  @php  
   $fotoPerfil = $aluno->FotoPerfil;   
   if(!$aluno->Ativo2){
     $checked = '';
   }
  @endphp
@endisset


<form method="post" action="{{route('aluno-registra')}}"  enctype="multipart/form-data">
    {{  csrf_field() }} <input type="hidden" name="id" id="id" value="0">

    <div class="row"> 

    <div class="col-md-2 mb-2 text-center">
      <label>Foto do perfil:</label>
      <a href="#" alt="clique para alterar foto" onclick="modal()">
      <div class="">
          <img class="profile-user-img img-fluid img-circle  elevation-2" src="{{asset($fotoPerfil)}}" alt="User profile picture">
          <p> Alterar foto </p>
    </div>
    </a>
  </div>
    
   
  <div class="col-md-3 ">
    @isset($aluno)
    <div class="row mb-2"><label>Matricula: {{$aluno->id}}</label></div>
    <div class="row mb-3"><label>Modalidades: </label>
      <p>@if($aluno->ListaModalidatesAtivas()) 
          @foreach($aluno->ListaModalidatesAtivas() as $modalidade)
          <tr>
           @if($modalidade)
             {{$modalidade->desc}}, 
             @endif
          </tr>
         @endforeach  
    
    @endif </p>
    </div>
     @endisset
    <div class="row">
        <input type="checkbox" 
               data-on-text="Ativo"  
               data-off-text="Inativo"  
               data-bootstrap-switch  
               name="_ativo" 
 
           {{$checked}}  
        >
    </div>
  </div>

  </div> 
    <div class="row">
      <div class="col-md-3">
         <div class="form-group">
            <label for=>CPF</label>
            <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Informe CPF..." @isset($aluno) @if($aluno) value="{{$aluno->cpf}}"  readonly @endif @endisset required>
         </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
            <label for="exampleInputEmail1">RG</label>
        <input type="text" class="form-control" id="rg" name="rg" @isset($aluno)  value="{{$aluno->rg}}" @endisset placeholder="Informe o RG... (opcional)">
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
            <label>Sexo</label>
             <select class="form-control" name="sexo" id="sexo">
                 <option value="Masculino">Masculino</option>
                 <option value="Feminino">Feminino</option>
                 <option value="Indefinido">Indefinido</option>
             </select>
        </div>
      </div>
      @isset($aluno)
      
        @php
          $aniversario = $aluno->dt_nacito;
        //data em ingles
        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$aniversario)){
            $aniversario = Carbon\Carbon::createFromFormat('Y-m-d', $aniversario);
        }
        //data em br
        if (preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/[0-9]{4}$/",$aniversario)){
            $aniversario = Carbon\Carbon::createFromFormat('d/m/Y', $aniversario);
        }
        @endphp


      @endisset
      <div class="col-md-3">
        <div class="form-group">
          <label>Data Nascimento</label>
          <div class="input-group">
               <div class="input-group-prepend">
                 <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
               </div>
              <input type="text" class="form-control" id="dt_nacito" name="dt_nacito" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" @isset($aluno) value="{{$aniversario->format('d/m/Y')}}" @endisset im-insert="false" required>
         </div>
        </div>
      </div>
    </div><!--close first row -->

    <div class="row">
      <div class="col-md-5">
        <div class="form-group">
          <label for="exampleInputEmail1">Nome completo</label>
        <input type="text" class="form-control" id="nome" name="nome" placeholder="Informe o nome completo..." @isset($aluno) value="{{$aluno->nome}}" @endisset required>
        </div>    
      </div>

      <div class="col-md-4">
          <div class="form-group">
              <label for="exampleInputEmail1">E-mail</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Email" @isset($aluno) value="{{$aluno->email}}" @endisset required>
         </div>              
      </div>

      <div class="col-md-3">
        <div class="form-group">
          <label>Data Cadastro</label>
          <div class="input-group">
               <div class="input-group-prepend">
                 <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
               </div>
              <input type="text" class="form-control" id="created_at" name="created_at" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" @isset($aluno) value="{{ date('d/m/Y', strtotime($aluno->created_at)) }}" @endisset im-insert="false" required>
         </div>
        </div>
      </div>
      
    </div>

    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label for="exampleInputEmail1">Celular</label>
          <div class="row">
         <div class="col-md-4">
          <select class="form-control" id="operadora1" name="operadora1">
              @include('admin.operadoras')
          </select>
        </div> 
        <div class="col-md-8"> 
          <input type="text" class="form-control" id="cel1" name="cel1" placeholder="Celular 1 (opcional)" @isset($aluno) value="{{$aluno->cel1}}" @endisset>
        </div>  
      </div>
      </div>        
      </div>

      <div class="col-md-4">
         
  <div class="form-group">
    <label for="exampleInputEmail1">Celular 2</label>
    <div class="row">
   <div class="col-md-4">
    <select class="form-control" id="operadora2" name="operadora2">
        @include('admin.operadoras')
    </select>
  </div> 
  <div class="col-md-8"> 
    <input type="text" class="form-control" id="cel2" name="cel2" placeholder="Celular 2 (opcional)" @isset($aluno) value="{{$aluno->cel2}}" @endisset >
  </div>  
</div>
</div>    

      </div>

      <div class="col-md-4">
        <div class="form-group">
             <label for="exampleInputEmail1">Telefone</label>
             <input type="text" class="form-control" id="tel" name="tel" placeholder="Telefone (opcional)" @isset($aluno) value="{{$aluno->tel}}" @endisset>
          </div>    
     </div>

    </div>


    <hr>
    <div class="row">
      <div class="col-md-2">
        <div class="form-group">
          <label>CEP</label>
          <input type="text" class="form-control" id="cep" name="cep" placeholder="CEP.. (opcional)" @isset($aluno) value="{{$aluno->cep}}" @endisset>
      </div>   
      </div>
      <div class="col-md-5">
        <div class="form-group">
          <label >Rua</label>
          <input type="text" class="form-control" id="rua" name="rua" placeholder="rua.. (opcional)" @isset($aluno) value="{{$aluno->rua}}" @endisset>
      </div>   
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <label>Numero</label>
          <input type="text" class="form-control" id="numero" name="numero" placeholder="numero.. (opcional)" @isset($aluno) value="{{$aluno->numero}}" @endisset>
      </div>  
      </div>

      <div class="col-md-3">
        <div class="form-group">
          <label>Complemento</label>
          <input type="text" class="form-control" id="complemento" name="complemento" placeholder="complemento.. (opcional)" @isset($aluno) value="{{$aluno->complemento}}" @endisset>
      </div> 
      </div>
    </div>
    





<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label>Bairro</label>
      <input type="text" class="form-control" id="bairro" name="bairro" placeholder="bairro.. (opcional)" @isset($aluno) value="{{$aluno->bairro}}" @endisset>
  </div>      
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>Cidade</label>
      <input type="text" class="form-control" id="cidade" name="cidade" placeholder="cidade.. (opcional)" @isset($aluno) value="{{$aluno->cidade}}" @endisset>
  </div>  
  </div>

  <div class="col-md-4">
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

</div>
<label>Observações</label>
<textarea class="form-control" name="obs" id="obs">
  @isset($aluno) {{$aluno->obs}} @endisset
</textarea>

    <input type="submit" class="btn btn-primary btn-block mt-3" value="Salvar alterações">
  </form>  

  <script src="{{asset('admin/plugins/moment/moment.min.js')}}"></script>
  <script src="{{asset('admin/plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
  <script src="{{asset('admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>

  <script>
    $(function () { 

        $("input[data-bootstrap-switch]").each(function(){
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });

        $('#dt_nacito').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
        $('#created_at').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
        $('#cpf').inputmask({ mask: ['999.999.999-99'], keepStatic: true });
        $('#cel1').inputmask({ mask: ['(99) 99999-9999'], keepStatic: true });
        $('#cel2').inputmask({ mask: ['(99) 99999-9999'], keepStatic: true });
        $('#tel').inputmask({ mask: ['(99) 9999-9999'], keepStatic: true });

        @isset($aluno)    
          $('#sexo').val('{{$aluno->sexo}}');
          $('#operadora1').val('{{$aluno->operadora1}}');
          $('#operadora2').val('{{$aluno->operadora2}}');
          $('#estado').val('{{$aluno->estado}}');
        @endisset

        @if(!$aluno)
            var str_data = new Date().getDate() + '/' + ((new Date().getMonth()) + 1 ) + '/' + new Date().getFullYear();
            $('#created_at').val(str_data);
        @endif  

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
 
function modal(){
  @isset($aluno)   
  $('#modal').modal('show');
  $('#modal-corpo').html('loading...');
  $('#modal-titulo').html('Selecionar foto do perfil:');
  requisicao('/app/aluno/foto','GET','{{$aluno->id}}')
    .then(result => {
      $('#modal-corpo').html(result);
    });
  @endisset 
  @if(!$aluno)
    alert('Salve os dados antes de alterar a foto');
  @endif

}


</script>