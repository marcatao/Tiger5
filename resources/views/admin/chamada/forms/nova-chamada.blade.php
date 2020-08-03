@extends('layouts.admin')

@section('estilo')


@endsection


@section('conteudo')
<div class="container-fluid">

  <br>
    <div class="card">
              <div class="card-header">
                <h3 class="card-title">Edição lista de presença </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{route('presenca-save')}}" method="POST">
                  {{  csrf_field() }}
                  <div class="row">
                    
                    <div class="col-md-2">
                    <div class="form-group">
                        <label>Data:</label>
                        <div class="input-group date" id="dt_aula" data-target-input="nearest" >
                             <input type="text" class="form-control datetimepicker-input" data-target="#dt_aula" id="dt_aula_val" name="dt_aula_val" required/>
                              <div class="input-group-append" data-target="#dt_aula" data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                              </div>
                        </div>
                     </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Hora inicial</label>
    
                        <div class="input-group date" id="hora_ini" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#hora_ini" id="hora_ini_val" name="hora_ini_val" required/>
                          <div class="input-group-append" data-target="#hora_ini" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="far fa-clock"></i></div>
                          </div>
                          </div>
                        <!-- /.input group -->
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Hora Final</label>
    
                        <div class="input-group date" id="hora_fim" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#hora_fim" id="hora_fim_val" name="hora_fim_val" required/>
                          <div class="input-group-append" data-target="#hora_fim" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="far fa-clock"></i></div>
                          </div>
                          </div>
                        <!-- /.input group -->
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Professor</label>
    
                        <div class="input-group date mao" onclick="selectProfessor()">
                          <input type="hidden" class="form-control" id="professor_id" name="professor_id"/>
                          <input type="text" class="form-control" id="professor_name" placeholder="Clique para selecionar..." readonly required/>
                          <div class="input-group-append">
                              <div class="input-group-text"><i class="fas fa-graduation-cap"></i></div>
                          </div>
                          </div>
                        <!-- /.input group -->
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Aula</label>
    
                        <div class="input-group date mao" onclick="selectAula()">
                          <input type="hidden" class="form-control" id="aula_id" name="aula_id" />
                          <input type="text" class="form-control" id="aula_name" placeholder="Clique para selecionar..." readonly required/>
                          <div class="input-group-append">
                              <div class="input-group-text"><i class="fas fa-graduation-cap"></i></div>
                          </div>
                          </div>
                        <!-- /.input group -->
                      </div>
                    </div>


                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Salvar</button>

                </form>
                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->


</div>
@include('admin.menus.modal')
@endsection

@section('scripts')
<!-- DataTables -->
<script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>

<script>
  $(function () {
   
    $('#dt_aula').datetimepicker({
        format: "DD/MM/YYYY",
    });

    $('#hora_ini').datetimepicker({
      format: "HH:mm",
    })
    $('#hora_fim').datetimepicker({
      format: "HH:mm",
    })
  });


function recebe_professor(ob){
  $('#professor_id').val(ob.id);
  $('#professor_name').val(ob.nome);
    console.log(ob);
}
function recebe_aula(ob){
  $('#aula_id').val(ob.id);
  $('#aula_name').val(ob.nome);
    console.log(ob);
}
function form_nova_chamada(){
  $('#modal').modal('show');
  $('#modal-corpo').html('loading...');
  $('#modal-titulo').html('Lista de presença');
  requisicao('{{route('form-nova-chamada')}}','GET')
    .then(result => {
      $('#modal-corpo').html(result);
    });
}
function selectProfessor(){
  $('#modal').modal('show');
  $('#modal-corpo').html('loading...');
  $('#modal-titulo').html('Selecione o Professor');
  requisicao('{{route('professor-selection')}}','GET')
    .then(result => {
      $('#modal-corpo').html(result);
    }); 
}
function selectAula(){
  $('#modal').modal('show');
  $('#modal-corpo').html('loading...');
  $('#modal-titulo').html('Selecione a Aula');
  requisicao('{{route('aula-selection')}}','GET')
    .then(result => {
      $('#modal-corpo').html(result);
    });
}
</script>
@endsection