
         <table class="table table-striped table-sm">
            <tr>
                <th>Pacote</th>

                <th>Valor Pago</th>
                <th>Pagamento</th>
                <th>Contratação</th>
                <th>Pagamento</th>
                <th>Aulas</th>
                <th>Renovacao</th>
                <th>Status</th>
                <th> </th>
                <th> </th>
            </tr>

            @foreach ($Maulas as $Maula)
            @php
             $danger ='';
             if($Maula->status_id == 6){
                 $danger = 'text-danger';
             }    
            @endphp
             <tr class="{{$danger}}">
                <td> {{$Maula->plano->titulo_plano}}</td>
                <td>R$ {{number_format($Maula->valor_pago,2,',',',')}}</td>
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
                    @endif
                </td>
                <td> 
                    <button class="btn btn-warning" onclick="chamar_form_plano_manual('{{$Maula->id}}')"> <i class="fas fa-edit"></i> </button>
                    
                </td>
             </tr>
            
         @endforeach
        </table>    

<script>

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
     