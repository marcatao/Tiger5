<form method="post" action="{{route('foto_form')}}"  enctype="multipart/form-data">
    {{  csrf_field() }}
    <input type="hidden" value="{{$id}}" id="id" name="id">
    <label  class="control-label">Selecione a Imagem de para o perfil:</label>
    <input type="file" name="file" id="file"  class="form-control" require><br>
    <button type="submit" class="btn btn-primary btn-block"> Savlar </button>
</form>