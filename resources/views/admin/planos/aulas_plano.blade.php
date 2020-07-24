<form method="post" action="{{route('aulas-plano')}}">
{{  csrf_field() }}
<input type="hidden" value="{{$plano_id}}" id="plano_id" name="plano_id">
<label>Selecione a aula:</label>
<select id="aula_id" name="aula_id" class="form-control mb-3">
    @foreach ($aulas as $aula)
         <option value="{{$aula->id}}">{{$aula->desc}}</option>
    @endforeach
</select>

<label>Selecione a quantidade de aulas</label>
<input type="number" class="form-control mb-3" name='qtd_aulas' id='qtd_aulas' required/>

<button type="submit" class="btn btn-primary btn-block mb-3"> Savlar </button>
</form>