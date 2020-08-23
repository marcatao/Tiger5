 
<table class="table table-striped table-sm">
@foreach ($planosDisponiveis as $plano)
<tr>
    <tr for="ativos_{{$plano->id}}">
    <td>
        <div class="icheck-success d-inline mr-3">
        <input type="checkbox" class="pagamentos" id="ativos_{{$plano->id}}" name="planos" value="{{$plano->id}}" checked>
            <label for="ativos_{{$plano->id}}"></label>
          </div>
    </td>
    <td for="ativos_{{$plano->id}}"> <label for="ativos_{{$plano->id}}">  {{$plano->plano->titulo_plano}}</label></td>
    <td for="ativos_{{$plano->id}}"><label for="ativos_{{$plano->id}}"> @if($plano->dt_pagamento) {{date('d/m/Y', strtotime($plano->dt_pagamento))}} @endif</label></td>
</tr>   
@endforeach
</table>
<button class="btn btn-block btn-primary" onclick="gerarMensalidades()">Gerar Mensalidades</button>

<script>

function formataDadosPagamentos(){
    const aluno_id = '{{$aluno_id}}';
    let planos_send = [];
    $(".pagamentos:checked").each(function() {
          planos_send.push($(this).val());
     });
     return {'aluno_id':aluno_id, 'planos_send': planos_send }
}


function gerarMensalidades(){
    const dados = formataDadosPagamentos();
    requisicao("{{route('adiciona-pagmanto-plano')}}",'post', dados)
      .then(result => {
        $('#modal-corpo').html(result);
        plano_aluno();
     });
}  
</script>