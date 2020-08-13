<table id="{{$table}}" class="table table-bordered table-striped table-hover">
    <thead>
    <tr>
 
      <th></th>
      <th>CPF</th>
      <th>Nome</th>
      <th>Celular</th>
      <th>E-mail</th>
      <th>Modalidades</th>
      <th> Status  </th>
    </tr>
    </thead>


    <tbody>
      @isset($alunos)
      @if ($alunos)
          @foreach ($alunos as $aluno)
            @php $status = "Em dia"; @endphp
              <tr id="linha_{{$aluno->id}}" onclick="aluno_select('{{route('edicao-alunos',$aluno->id)}}')" >
                <td style="cursor: pointer;"><img src="{{asset($aluno->FotoPerfil)}}" class="profile-user-img img-fluid"></td>
                <td style="cursor: pointer;">{{ $aluno->cpf }}</td>
                <td style="cursor: pointer;">{{ $aluno->nome }}</td>
                <td style="cursor: pointer;">{{ $aluno->Celular1}}</td>
                <td style="cursor: pointer;">{{ $aluno->email }}</td>
                <td style="cursor: pointer;">
                @if($aluno->ListaModalidatesAtivas()) 
                  <table>
                     @foreach($aluno->ListaModalidatesAtivas() as $modalidade)
                      <tr>
                       @if($modalidade)
                        <td>{{$modalidade->desc}}</td><td>{{date('d/m', strtotime($modalidade->dt_pagamento))}}</td>
                        @php
                            if($modalidade->status_id == 6){
                              $status = "<b class='text-danger'>Pagamento atrasado</b>";
                            }   
                        @endphp
                       @endif
                      </tr>
                     @endforeach  
                  </table>  
                @endif 
                </td>
                <td>{!!$status!!}</td>
                <!--<td>include('admin.alunos.elementos.botaoEditar')</td>-->
              </tr>  
 
          @endforeach
      @endif    
     @endisset
      

    </tbody>

  </table>


<script>
    $(function () {
        tabela('{{$table}}');
    });

    function aluno_select(link){
      console.log(link);
      window.location = link;
    }
</script>