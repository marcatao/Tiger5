<div class="col-md-12">
@if($Maula)
<hr>
<h3 class="text-center mb-3 mt-2">Relatórios de Mensalidades</h3>
<hr>
<table class="table table-striped table-sm mt-2" >
    <thead>
        <th>Plano</th>
        <th>Aluno</th>
        <th>Valor</th>
        <th>Pagamento</th>
        <th>Data Pgto</th>
        <th>Forma Pagto</th>
        <th>Obs</th>
    </thead>
    <tbody>
    @foreach ($Maula as $r)
    @php
    $danger ='';
    if($r->status_id == 6){
        $danger = 'text-danger';
    }    
   @endphp
    <tr class="{{$danger}}">
            <td>{{$r->plano->titulo_plano}}</td>
            <td>{{$r->aluno->nome}}</td>
            <td>{{number_format($r->valor_plano,2,',','.')}}</td>
            <td>{{number_format($r->valor_pago,2,',','.')}}</td>
            <td>@if($r->dt_pagamento) {{date('d/m/Y', strtotime($r->dt_pagamento))}} @endif</td>
            <td>{{$r->formaPagamento->descicao}}</td>
            <td>@if($r->status_id == 6) {{$r->statusDesc->descricao}} @endif</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
        <th>{{count($Maula)}} registros</th>
        <th></th>
        <th>{{number_format($Maula->sum('valor_plano'),2,',','.')}}</th>
        <th>{{number_format($Maula->sum('valor_pago'),2,',','.')}}</th>
        <th> </th>
        <th> </th>
        <th> </th>
    </tfoot>
</table>

<hr>
@endif
</div>