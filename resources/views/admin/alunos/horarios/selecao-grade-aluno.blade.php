@foreach ($grade_aluno as $item)
    {{$item}}
@endforeach
<input type="hidden" name="qt_disponivel" id="qt_disponivel" value="{{$qt_disponivel}}">
<p>Aulas disponiveis:<b id="qt_disponivel_txt">{{$qt_disponivel}}</b>
<table class="table">
@foreach ($grades as $grade)
    <tr>    
 
        <td><input type="checkbox" 
                   class="form-control" 
                   name="grade_select" 
                   id="grade_select_{{$grade->id}}"
                   value="{{$grade->id}}" 
                   @if(in_array($grade->id,$grade_aluno)) checked  @endif
                   onclick="seleciona_check(this.checked,this.value)"></td>
        <td>{{$grade->dia}}</td>
        <td>{{$grade->hora_ini}}</td>
        <td>{{$grade->hora_fim}}</td>
    </tr>
@endforeach
</table>

<script>
function seleciona_check(action,id){
    let qt_disponivel = parseInt($('#qt_disponivel').val());
    salva_acao_check(action, id);
    if(action){
        qt_disponivel -= 1;
    }else{
        qt_disponivel += 1;
    }
    
    ajusta_check(qt_disponivel);
   
    $('#qt_disponivel').val(qt_disponivel);
    $('#qt_disponivel_txt').html(qt_disponivel);
}
function ajusta_check(qt_disponivel){
    console.log('chamou')
    $("input[type='checkbox']:not(:checked):not('\#chkAll\')").map(function () { 
            if(qt_disponivel <= 0){
                $('#'+this.id).attr("disabled", true);
            }else{
                $('#'+this.id).removeAttr("disabled");
            }
        }).get().join();
}

function salva_acao_check(action,gradeAula_id){
    const aluno_id = '{{$aluno_id}}';
    requisicao('{{route('selecao_grade_aluno')}}','post',action,gradeAula_id,aluno_id)
    .then(result => {
      console.log(result);
    });
}
</script>