<link rel="stylesheet" href="{{ asset('css/custon.css')}}">

<a href="#"  onclick="lancarPagamento()" class="botao-canto bg-success" alt="Adicionar pagamento">
    <i class="fas fa-money-bill-alt" aria-hidden="true"></i>
  </a>  

@php
    $aluno_id = 0;
@endphp
         <table class="table table-striped table-sm">
            <tr>
                <th>Pacote</th>

                <th>Vl Plano</th>
                <th>Pagamento</th>
                <th>Contratação</th>
                <th>Pagamento</th>
                <th>Aulas</th>
                <th>Plano</th>
                <th>Status</th>
                <th> </th>
                <th> </th>
            </tr>

            @foreach ($Maulas as $Maula)
            @php
             $danger ='';
             $aluno_id = $Maula->aluno_id;
             if($Maula->status_id == 6){
                 $danger = 'text-danger';
             }    
            @endphp
             <tr class="{{$danger}}">
                <td> {{$Maula->plano->titulo_plano}}</td>
                <td>R$ {{number_format($Maula->valor_plano,2,',',',')}}</td>
                <td> {{ $Maula->formaPagamento->descicao }}</td>
                <td>@if($Maula->dt_aquisicao) {{date('d/m/Y', strtotime($Maula->dt_aquisicao))}} @endif</td>
                <td>@if($Maula->dt_pagamento) {{date('d/m/Y', strtotime($Maula->dt_pagamento))}} @endif</td>
                <td>{{$Maula->aulas->count()}} /   {{ $Maula->QtdAulasEncerradas->count() }}</td>
                <td> {{ $Maula->RenovacaoText }}  </td>
                <td> @if($Maula->statusDesc) 
                      {{ $Maula->statusDesc->descricao }} 
                    @endif
                </td>
                <td> @if(   ($Maula->status_id == 6) or ($Maula->status_id==1 && $Maula->valor_pago == 0) )
                    <button class="btn btn-danger" onclick="adicionar_pagamento_maula('{{$Maula->id}}')"> Pagar </button>
                    @elseif($Maula->status_id==1 && $Maula->valor_pago <> 0)
                    
                    @endif
                </td> 
                <td> 
                    <button class="btn btn-warning" onclick="chamar_form_plano_manual('{{$Maula->id}}')"> <i class="fas fa-edit"></i> </button>
                    
                </td>
             </tr>
            
         @endforeach
        </table>    

<script>

function lancarPagamento(){
    $('#modal').modal('show');
    $('#modal-titulo').html('Selecione os Planos que serão pagos');
    requisicao("{{route('adiciona-pagmanto-plano')}}",'GET', '{{$aluno_id}}')
      .then(result => {
        $('#modal-corpo').html(result);
     });
}

function adicionar_pagamento_maula(id){
    console.log(id);
      $('#modal').modal('show');
      $('#modal-titulo').html('Informe os dados do pagamento:');
      requisicao("{{route('pagmanto-plano')}}",'GET',id)
      .then(result => {
        $('#modal-corpo').html(result);
     });
}

</script>
     