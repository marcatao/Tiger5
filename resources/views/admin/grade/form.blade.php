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


                                
                    <label>Inicio da aula</label>
                    <div class="input-group date col-md-3" id="timepicker" data-target-input="nearest">
                      <input type="text" class="form-control datetimepicker-input" data-target="#timepicker" id="hora_ini" name="hora_ini"  @if($grade) value="{{$grade->hora_ini}}" @endif required/>
                      <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="far fa-clock"></i></div>
                      </div>
                    </div>
                    <label>Temino da aula</label>
                    <div class="input-group date col-md-3" id="timepicker2" data-target-input="nearest">
                      <input type="text" class="form-control datetimepicker-input" data-target="#timepicker2" id="hora_fim" name="hora_fim"  @if($grade) value="{{$grade->hora_fim}}" @endif required/>
                      <div class="input-group-append" data-target="#timepicker2" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="far fa-clock"></i></div>
                      </div>
                    </div>
                     
                    <br>


                  
                    <button type="submit" class="btn btn-primary btn-block"> Savlar </button>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->


</div>
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
      });
  @endif    
  </script>
  @endsection

