@extends('layouts.admin')

@section('estilo')
 
@endsection


@section('conteudo')


<div class="col-md-12 mt-2">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Mensalidades, selecione o intervalo</h3>
      </div>
      <div class="card-body">


<div class="row">
        <div class="form-group col-md-3">
            
              <div class="input-group date" id="dt1" data-target-input="nearest">
                  <input type="text" class="form-control datetimepicker-input" data-target="#dt1" id="dt1_val"/>
                  <div class="input-group-append" data-target="#dt1" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
              </div>
          </div>
 
          <div class="form-group col-md-3">
            
              <div class="input-group date" id="dt2" data-target-input="nearest">
                  <input type="text" class="form-control datetimepicker-input" data-target="#dt2" id="dt2_val"/>
                  <div class="input-group-append" data-target="#dt2" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
              </div>
          </div>

          <div class="col-md-3">
          
            <button class="btn btn-primary" id="btn_carrega">Carregar</button>
          </div>

    </div>

    <div class="row">
   

        <div class="form-group clearfix mt-2">
          <div class="icheck-success d-inline ml-3">
            <input type="checkbox" id="ativos">
            <label for="ativos">
              Ativos
            </label>
          </div>
 
          <div class="icheck-warning d-inline ml-3">
            <input type="checkbox" id="atrasados">
            <label for="atrasados">
              Atrasados
            </label>
          </div>

          <div class="icheck-danger d-inline ml-3">
            <input type="checkbox" id="encerrados">
            <label for="encerrados">
              Encerrados
            </label>
          </div>
        </div>
    </div>

</div>



</div></div></div>
@endsection



@section('scripts')
<script>
  $(function () {
    $('#dt1').datetimepicker({
        format: 'DD/MM/YYYY'
    });
    $('#dt2').datetimepicker({
        format: 'DD/MM/YYYY'
    });
  });

function prepara_data(){
    const dt1 = $('#dt1_val').val();
    const dt2 = $('#dt2_val').val();
    
    console.log($('#ativos').attr('checked'));
    return ({
        "dt1":dt1,
        "dt2":dt2,
    });
}

$("#btn_carrega").click(function() {

 const data = prepara_data();
 console.log(data);

});
</script>
@endsection