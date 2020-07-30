<form method="post" action="{{route('professor-form-unidade')}}">
    {{  csrf_field() }}
    <input type="hidden" value="{{$professor_id}}" id="professor_id" name="professor_id">
    <label>Selecione a Unidade:</label>
    <select id="unidade_id" name="unidade_id" class="form-control mb-3">
        @foreach ($unidades as $unidade)
             <option value="{{$unidade->id}}">{{$unidade->titulo}}</option>
        @endforeach
    </select>
    
    <button type="submit" class="btn btn-primary btn-block mb-3"> Savlar </button>
    </form>