<div class="btn-group">
    <a href="{{route('edicao-alunos',$aluno->id)}}" class="btn btn-default">Editar</a>
    <button type="button" class="btn btn-default dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown" aria-expanded="false">
      <span class="sr-only">Toggle Dropdown</span>
      <div class="dropdown-menu" role="menu" style="">
        <a class="dropdown-item" href="#">Criar login</a>
        <div class="dropdown-divider"></div>
      <a class="dropdown-item text-danger" href="#" onclick="delete_confirm('{{$aluno->id}}','{{$aluno->nome}}')">Excluir</a>
      </div>
    </button>
</div>