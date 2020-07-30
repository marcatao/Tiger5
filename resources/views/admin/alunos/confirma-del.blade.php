<form method="post" action="{{route('deleta_form')}}"  enctype="multipart/form-data">
    {{  csrf_field() }}
    <input type="hidden" value="{{$aluno->id}}" id="id" name="id">
    <label  class="control-label">Deletar {{$aluno->nome}}:</label>
    <button type="submit" class="btn btn-danger btn-block"> Deletar </button>
</form>