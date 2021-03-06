


 @php
    $alunos = App\aluno::where('id',$id)->get();
  @endphp

<!--<form>-->
    <div class="row">
        <div class="col-md-4">
            <label>Aluno</label>
            <select class="form-control" name="aluno_id" id="aluno_id" readonly>
                @foreach ($alunos as $aluno)
                    <option value="{{$aluno->id}}">{{$aluno->nome}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-5">
            <label>Selecione o plano:</label>
            <select class="form-control" id="plano_id" name="plano_id">
                @foreach (App\planos::where('academia_id',auth()->user()->academia_id)->get() as $plano)
                    <option value="{{$plano->id}}">{{$plano->titulo_plano}} - (R$ {{number_format($plano->valor_plano,2,",",".")}})</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label>Plano:</label>
            <select class="form-control" id="renovacao" name="renovacao">
                <option value="1">Mensal</option>
                <option value="0">Unico</option>
            </select>
        </div>

    </div> 
    <div class="row">

        <div class="col-md-3">
            <div class="form-group">
                <label>Data Inicio/vencimento:</label>
                <div class="input-group date" id="dt_pagamento" data-target-input="nearest" >
                     <input type="text" 
                            class="form-control datetimepicker-input" 
                            data-target="#dt_pagamento" 
                            id="dt_pagamento_val" 
                            name="dt_pagamento_val" 
                            @if($Maula) value="{{date('d/m/Y', strtotime($Maula->dt_pagamento))}}"
                            @else 
                                @if ($alunos[0]->dia_venc)
                                value="{{$alunos[0]->dia_venc}}{{date('/m/Y', strtotime(now()))}}" 
                                @endif
                            @endif
                            required/>
                      <div class="input-group-append" data-target="#dt_pagamento" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                </div>
             </div>
            </div>


        <div class="col-md-3">
            <label>Pagamento:</label>
            <select class="form-control" id="formapagamento_id" name="formapagamento_id">
                @foreach (App\FormaPagamento::all() as $pagamento)
                      <option value="{{$pagamento->id}}">{{$pagamento->descicao}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <label>Valor pago:</label>
            <input type="text" name="valor_pago" id="valor_pago" class="form-control" required>
        </div>
        <div class="col-md-2">
            <label>Status:</label>
            <select class="form-control" id="status_id" name="status_id"  @if(!$Maula) disabled @endif>
                @if(!$Maula) <option value=""></option> @endif
                @foreach (App\status::where('id','<','7')->get() as $status)
                      <option value="{{$status->id}}">{{$status->descricao}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 mt-2">
            @if($Maula)
            <div class="row">
                <div class="col-md-7">
                    <button class="btn btn-warning btn-block mt-4" id="btn_edita_plano">Alterar</button>
                </div>
                <div class="col-md-5">
                    <button class="btn btn-danger btn-block mt-4" id="btn_deleta_plano"><i class="fas fa-trash"></i></button>
                </div>
            </div>
            @else 
            
            <button class="btn btn-primary btn-block mt-4" id="btn_post_plano">Salvar</button>
            
            @endif      
            
        </div>

    </div>
<!--</form>   -->

<div id="feed"></div>


<script src="{{asset('admin/plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
    
<script>
  $(function () {
    @if($Maula)
        $('#plano_id').val('{{$Maula->plano_id}}');
        $('#renovacao').val('{{$Maula->renovacao}}');
        $('#formapagamento_id').val('{{$Maula->formapagamento_id}}');
        $('#valor_pago').val('{{$Maula->valor_pago}}');
        $('#status_id').val('{{$Maula->status_id}}');
    @endif

    $('#dt_pagamento').datetimepicker({
        format: "DD/MM/YYYY",
    });


        $('#valor_pago').inputmask('decimal', {
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
function prepara_data(){
    const aluno_id = $('#aluno_id').val();
    const plano_id = $('#plano_id').val();
    const formapagamento_id = $('#formapagamento_id').val();
    const valor_pago = $('#valor_pago').val();
    const dt_pagamento =  $('#dt_pagamento_val').val();
    const renovacao =$('#renovacao').val();
    const status_id=$('#status_id').val();
    
    const dataSend = {"aluno_id":aluno_id,
                      "plano_id":plano_id,
                      "formapagamento_id":formapagamento_id,
                      "valor_pago":valor_pago,
                      "dt_pagamento":dt_pagamento,
                      "renovacao":renovacao,
                      "status_id":status_id };
    return dataSend;                      
}


//NOVO PLANO
$('#btn_post_plano').click(function(e) {
    const dataSend = prepara_data();
    console.log(dataSend);
  if(dataSend.dt_pagamento =="" || dataSend.valor_pago ==""){
    window.Toast.fire({icon: 'error', title: 'Preencha todos os campos!'});
    return;
  }  
  requisicao('{{route('post-plano')}}','GET', dataSend)
    .then(result => {
        plano_aluno();
        window.Toast.fire({icon: 'success', title: 'Plano registrado com seucesso!'});
    });
});   

@if($Maula)
//EDITA PLANO
$('#btn_edita_plano').click(function(e) {
    const dataSend = prepara_data();
    console.log(dataSend+' Editando ');
  if(dataSend.dt_pagamento =="" || dataSend.valor_pago ==""){
    window.Toast.fire({icon: 'error', title: 'Preencha todos os campos!'});
    return;
  }  
  requisicao('{{route('post-plano')}}','GET', dataSend, '{{$Maula->id}}')
    .then(result => {
        plano_aluno();
        window.Toast.fire({icon: 'success', title: 'Plano alterado com seucesso!'});
    });
});  

//Deleta Plano
$('#btn_deleta_plano').click(function(e) {
    const dataSend = prepara_data();
    console.log(dataSend+' Editando ');
  if(dataSend.dt_pagamento =="" || dataSend.valor_pago ==""){
    window.Toast.fire({icon: 'error', title: 'Preencha todos os campos!'});
    return;
  }  
  requisicao('{{route('post-plano')}}','GET', dataSend, '{{$Maula->id}}', 'deleta')
    .then(result => {
        plano_aluno();
        window.Toast.fire({icon: 'success', title: 'Plano excluido com seucesso!'});
    });
});  
@endif
</script>


