@foreach ($Maula as $MestreAula)
         <p>Plano: {{$MestreAula->plano->titulo_plano}}</p>
         <p>Valor pago: R${{number_format($MestreAula->valor_pago,2,',','.')}}</p>
         <table class="table table-striped table-sm">
            <tr>
                <th>Aula</th>
                <th>Dt Aquisição</th>
                <th>Dt Prazo</th>
                <th>Dt Aula</th>
                <th>Professor</th>
                <th>Status</th>
            </tr>

         @foreach ($MestreAula->aulas as $aula)
             <tr>
                 <td>{{$aula->detalhe->desc}}</td>
                <td>@if($aula->dt_inicio) {{date('d/m/Y', strtotime($aula->dt_inicio))}} @endif</td>
                <td>@if($aula->dt_fim) {{date('d/m/Y', strtotime($aula->dt_fim))}} @endif</td>
                <td>@if($aula->dt_utilizacao) {{date('d/m/Y', strtotime($aula->dt_utilizacao))}} @else A realizar @endif</td>
                <td> {{$aula->professor_id}}</td>
                <td>  {{ $aula->StatusAula->descricao }} </td>
             </tr>
            
         @endforeach
        </table>   
@endforeach