@if($Maula)


<p>Plano:<strong>{{$Maula->plano->titulo_plano}}</strong></p>
<p>Vencimento: <strong>{{date('d/m/Y', strtotime($Maula->dt_pagamento))}}</strong></p>
<div class="col-md-12">
    <label>Pagamento:</label>
    <select class="form-control" id="forma_pagar" name="forma_pagar">
        @foreach (App\FormaPagamento::all() as $pagamento)
              <option value="{{$pagamento->id}}">{{$pagamento->descicao}}</option>
        @endforeach
    </select>
</div>
<div class="col-md-12">
    <label>Valor pago:</label>
    <input type="text" name="valor_pagar" id="valor_pagar" class="form-control" required>
</div><br>

<button class="btn btn-primary btn-block" onclick="SalvarPagamento()"> Realizar pagamento </button>


<script>
  $(function () {
    $('#valor_pagar').inputmask('decimal', {
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

function SalvarPagamento(){

    const maula_id = {{$Maula->id}};
    const formapagamento_id = $('#forma_pagar').val();
    const valor_pago = $('#valor_pagar').val();
    
    const dataSend = {"maula_id":maula_id,
                      "formapagamento_id":formapagamento_id,
                      "valor_pago":valor_pago
                      };
    console.log(dataSend);

  if(formapagamento_id =="" || valor_pago ==""){
    window.Toast.fire({icon: 'error', title: 'Preencha todos os campos!'});
    return;
  }  
    
    requisicao("{{route('salvar-plano')}}",'post',dataSend)
      .then(result => {
        $('#modal-corpo').html(result);
        carrega_plano_maula_aluno();
        window.Toast.fire({icon: 'success', title: 'Pagamento realizado com sucesso!'});

     });
}


</script>

@endif