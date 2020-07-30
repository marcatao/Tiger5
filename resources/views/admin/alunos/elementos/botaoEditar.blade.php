<div class="btn-group">
    <a href="{{route('edicao-alunos',$aluno->id)}}" class="btn btn-default">Editar</a>
    <button type="button" class="btn btn-default dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown" aria-expanded="false">
      <span class="sr-only">Toggle Dropdown</span>
      <div class="dropdown-menu" role="menu" style="">
        <a class="dropdown-item" href="#" onclick="del('{{$aluno->id}}')">Excluir cadastro</a>
        <div class="dropdown-divider"></div>
        @if(!$aluno->ativo)
           <a class="dropdown-item" href="#" onclick="ativo('{{$aluno->id}}','1')">Ativar</a>
        @else
           <a class="dropdown-item text-danger" href="#" onclick="ativo('{{$aluno->id}}','0')">Inativar</a>
        @endif
        </div>
    </button>
</div>