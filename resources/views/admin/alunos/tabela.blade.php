<table id="{{$table}}" class="table table-bordered table-striped table-hover">
    <thead>
    <tr>
 
      <th></th>
      <th>CPF</th>
      <th>Nome</th>
      <th>Celular</th>
      <th>E-mail</th>
      <th>Cadastro</th>
      <th>  </th>
    </tr>
    </thead>


    <tbody>
      @isset($alunos)
      @if ($alunos)
          @foreach ($alunos as $aluno)

              <tr id="linha_{{$aluno->id}}" data-url="{{route('edicao-alunos',$aluno->id)}}" >
                <td style="cursor: pointer;"><img src="{{asset($aluno->FotoPerfil)}}" class="profile-user-img img-fluid"></td>
                <td style="cursor: pointer;">{{ $aluno->cpf }}</td>
                <td style="cursor: pointer;">{{ $aluno->nome }}</td>
                <td style="cursor: pointer;">{{ $aluno->Celular1}}</td>
                <td style="cursor: pointer;">{{ $aluno->email }}</td>
                <td style="cursor: pointer;">{{ date('d/m/Y', strtotime($aluno->created_at)) }}</td>
                <td>@include('admin.alunos.elementos.botaoEditar')</td>
              </tr>  

          @endforeach
      @endif    
     @endisset
      

    </tbody>

  </table>


<script>
    $(function () {
        tabela('{{$table}}');

        $('table tr').click(function(){
          window.location = $(this).data('url');
          returnfalse;
        });
    });
</script>