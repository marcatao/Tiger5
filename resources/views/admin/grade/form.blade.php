@extends('layouts.admin')


@section('conteudo')
<div class="container-fluid">

    <br>
    <div class="card">
              <div class="card-header">
                <h3 class="card-title">Edição grade de Aula</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <form method="post" action="{{route('create-form-grade',$id)}}">
                    {{  csrf_field() }}
                    <input type="hidden" value="{{$id}}" id="id" name="id">

                    <div class="row">
                      <div class="col-md-6">
                           <label>Selecione o dia  da semana</label>
                           <select id="dia" name="dia" class="form-control" required>
                           @php $diasemana = array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado'); @endphp
                           @if($grade) 
                              <option id="{{$grade->dia}}">{{$grade->dia}}</option>                      
                           @endif
                           @foreach ($diasemana as $d)
                              <option id="{{$d}}">{{$d}}</option>
                           @endforeach
                        </select><br>
                      </div>

                      <div class="col-md-6">
                        <label>Selecione a aula</label>
                        <select id="aula_id" name="aula_id" class="form-control">
                          @if($grade) 
                               <option value="{{$grade->aula_id}}">{{$grade->aula->desc}}</option>                      
                          @endif
                            @foreach ($aulas as $aula)
                              <option value="{{$aula->id}}">{{$aula->desc}}</option>
                            @endforeach
                        </select> 
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-md-6">
                        <label>Selecione o professor</label>
                        <select id="professor_id" name="professor_id" class="form-control">
                          @foreach ($professores as $professor)
                              <option value="{{$professor->id}}">{{$professor->user->name}}</option>
                            @endforeach
                        </select><br>
                      </div>
                      <div class="col-md-6">
                        <label>Selecione e unidade.</label>
                        <select id="unidade_id" name="unidade_id" class="form-control">
                          @foreach ($unidades as $unidade)
                              <option value="{{$unidade->id}}">{{$unidade->titulo}}</option>
                            @endforeach
                        </select><br>
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-md-6">
                    <label>Inicio da aula</label>
                    <div class="input-group date col-md-12" id="timepicker" data-target-input="nearest">
                      <input type="text" class="form-control datetimepicker-input" data-target="#timepicker" id="hora_ini" name="hora_ini"  @if($grade) value="{{$grade->hora_ini}}" @endif required/>
                      <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="far fa-clock"></i></div>
                      </div>
                    </div>
                    <label>Temino da aula</label>
                    <div class="input-group date col-md-12" id="timepicker2" data-target-input="nearest">
                      <input type="text" class="form-control datetimepicker-input" data-target="#timepicker2" id="hora_fim" name="hora_fim"  @if($grade) value="{{$grade->hora_fim}}" @endif required/>
                      <div class="input-group-append" data-target="#timepicker2" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="far fa-clock"></i></div>
                      </div>
                    </div>
                      </div>
                      <div class="col-md-6">
                        <label>Disponibilidade</label>
                         <select name="status_id" id="status_id" class="form-control">
                              <option value="1">Ativo</option>
                              <option value="11">Indisponivel</option>
                         </select>
                      </div>
                  </div>            
                    <br>


                  
                    <button type="submit" class="btn btn-primary btn-block mb-1"> Salvar </button>
                    <a href="{{route('grade-aula')}}" class="btn btn-outline-warning btn-block"> Voltar </a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->



@if($grade)   
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Alunos que participam dessa grade</h3>
  </div>
  
  <div class="card-body">
    @php
        $alunos = App\grade_aluno::where('gradeAula_id',$grade->id)->pluck('aluno_id')->toArray();
        $alunos = App\aluno::whereIn('id',$alunos)->get();
    @endphp
    <table class="table">
      @foreach ($alunos as $aluno)
          <a href="{{route('edicao-alunos',$aluno->id)}}" target="_blank" class="mb-3">
            <tr class="mao mb-3">
            <td style="cursor: pointer;" ><img src="{{asset($aluno->FotoPerfil)}}"  width='50px' class="profile-user-img img-fluid"></td>
            <td><h4>{{$aluno->nome}}</h4></td>
          </tr>
          </a>
      @endforeach
    </table>
  </div>
</div>   

@endif

</div><!--container -->
@endsection

@section('scripts')


<script>
$(function () {
  
    $('#timepicker').datetimepicker({
      format: 'HH:mm',
        pickDate: false,
        pickSeconds: false,
        pick12HourFormat: false  
    });
    $('#timepicker2').datetimepicker({
      format: 'HH:mm',
        pickDate: false,
        pickSeconds: false,
        pick12HourFormat: false  
    });
});

  @if($grade)    
      $(function () {
           $('#professor_id').val({{$grade->professor_id}});
           $('#status_id').val({{$grade->status_id}});
      });
  @endif    
  </script>
  @endsection

