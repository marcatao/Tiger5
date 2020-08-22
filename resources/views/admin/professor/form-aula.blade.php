<form method="post" action="{{route('professor-form-aula')}}">
    {{  csrf_field() }}
    <input type="hidden" value="{{$professor_id}}" id="professor_id" name="professor_id">
    <label>Selecione a Unidade:</label>
    <select id="aula_id" name="aula_id" class="form-control mb-3">
        @foreach ($aulas as $aula)
             <option value="{{$aula->id}}">{{$aula->desc}}</option>
        @endforeach
    </select>
    
    <button type="submit" class="btn btn-primary btn-block mb-3"> Savlar </button>
    </form>