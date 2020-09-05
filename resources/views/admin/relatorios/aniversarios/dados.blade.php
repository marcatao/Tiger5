@php
    $meses = array(
    '01'=>'Janeiro',
    '02'=>'Fevereiro',
    '03'=>'Março',
    '04'=>'Abril',
    '05'=>'Maio',
    '06'=>'Junho',
    '07'=>'Julho',
    '08'=>'Agosto',
    '09'=>'Setembro',
    '10'=>'Outubro',
    '11'=>'Novembro',
    '12'=>'Dezembro'
);
@endphp

<h3 class="text-center mb-2 mt-5">Aniversariantes do mês de {{$meses[$mes]}}</h3>
<table id="Aluno1" class="table table-bordered table-striped table-hover mt-3">
    <thead>
    <tr>
      <th>Dia</th>   
      <th></th>
      <th>Nome</th>
      <th>Modalidades</th>
      <th>Idade</th>
    </tr>
    </thead>


    <tbody>
      @isset($alunos)
      @if ($alunos)
      @php $sorted = $alunos->sortKeys(); @endphp
 
          @foreach ($sorted as $aluno_dia)
            @foreach ($aluno_dia as $aluno)
            
            @php $status = "Em dia"; @endphp
              <tr>
                <td>{{date('d', strtotime($aluno->dt_nacito))}}</td>
                <td><img src="{{asset($aluno->FotoPerfil)}}" class="profile-user-img img-fluid"></td>
                <td>{{ $aluno->nome }}</td>
                <td>
                @if($aluno->ListaModalidatesAtivas()) 
                     @foreach($aluno->ListaModalidatesAtivas() as $modalidade)
                       @if($modalidade)
                        {{$modalidade->desc}}<br>
                       @endif
                     @endforeach  
                @endif 
                </td>
                <td>{{date('Y', strtotime(now())) - (date('Y', strtotime($aluno->dt_nacito)))}}</td>
              </tr>  
                
              @endforeach
          @endforeach
      @endif    
     @endisset
      

    </tbody>

  </table>

