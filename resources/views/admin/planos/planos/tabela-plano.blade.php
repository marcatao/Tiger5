
         <table class="table table-striped table-sm">
            <tr>
                <th>Pacote</th>
                <th>Aula</th>
                <th>Inicio</th>
                <th>Termino</th>
                <th>Aula</th>
                <th>Professor</th>
                <th>Status</th>
            </tr>

            @foreach ($Faulas as $Faula) 
             <tr>
                <td>{{$Faula->Maula->plano->titulo_plano}}</td>
                <td>{{$Faula->detalhe->desc}}</td>
                <td>@if($Faula->dt_inicio) {{date('d/m/Y', strtotime($Faula->dt_inicio))}} @endif</td>
                <td>@if($Faula->dt_fim) {{date('d/m/Y', strtotime($Faula->dt_fim))}} @endif</td>
                <td>@if($Faula->dt_utilizacao) {{date('d/m/Y', strtotime($Faula->dt_utilizacao))}} @else A realizar @endif</td>
                <td> @if($Faula->Professor) {{$Faula->Professor->user->ShortName}} @endif</td>
                <td>  {{ $Faula->StatusAula->descricao }} </td>
             </tr>
            
         @endforeach
        </table>    
 