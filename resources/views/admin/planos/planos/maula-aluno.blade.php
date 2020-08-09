
         <table class="table table-striped table-sm">
            <tr>
                <th>Pacote</th>
                <th>Valor Plano</th>
                <th>Valor Pago</th>
                <th>Pagamento</th>
                <th>Contratação</th>
                <th>Pagamento</th>

                <th>Aulas</th>
                <th>Status</th>
            </tr>

            @foreach ($Maulas as $Maula)
             <tr>
                <td> {{$Maula->plano->titulo_plano}}</td>
                <td>R$ {{number_format($Maula->valor_plano,2,',',',')}}</td>
                <td>R$ {{number_format($Maula->valor_pago,2,',',',')}}</td>
                <td> {{ $Maula->formaPagamento->descicao }}</td>
                <td>@if($Maula->dt_aquisicao) {{date('d/m/Y', strtotime($Maula->dt_aquisicao))}} @endif</td>
                <td>@if($Maula->dt_pagamento) {{date('d/m/Y', strtotime($Maula->dt_pagamento))}} @endif</td>

                <td>{{$Maula->aulas->count()}} /   {{ $Maula->QtdAulasEncerradas->count() }}</td>
                <td> {{ $Maula->statusDesc->descricao }}  </td>
             </tr>
            
         @endforeach
        </table>    

 
     