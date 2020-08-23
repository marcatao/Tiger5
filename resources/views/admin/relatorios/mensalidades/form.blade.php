@extends('layouts.admin')
@section('estilo')
<link rel="stylesheet" href="{{ asset('css/custon.css')}}">
 
@endsection


@section('conteudo')

<a href="#" onclick="printDiv('relatorios-faturas')" class="botao-canto bg-primary">
  <i class="fa fa-print" aria-hidden="true"></i>
</a>  

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
            <input type="checkbox" id="ativos_chk" checked>
            <label for="ativos_chk">
              Mensalidades Pagas
            </label>
          </div>
 
          <div class="icheck-warning d-inline ml-3">
            <input type="checkbox" id="atrasados_chk" checked>
            <label for="atrasados_chk">
              Mensalidades à Pagar
            </label>
          </div>

        </div>
    </div>

</div>

 
 
    <div id="relatorios-faturas"></div>
 

</div></div></div>
@endsection



@section('scripts')
<script>
  $(function () {
    var date = new Date();
    $('#dt1').datetimepicker({
        format: 'DD/MM/YYYY',
        date: new Date(date.getFullYear(), date.getMonth(), 1),
    });
    $('#dt2').datetimepicker({
        format: 'DD/MM/YYYY',
        date: Date(date.getFullYear(), date.getMonth() + 1, 0),
    });
  });


function prepara_data(){
    const dt1 = $('#dt1_val').val();
    const dt2 = $('#dt2_val').val();
    var status_id=[];
    if($('#ativos_chk').on()[0].checked)  status_id.push(1);
    if($('#atrasados_chk').on()[0].checked)  status_id.push(6);


    return ({"dt1":dt1, "dt2":dt2,"status_id":status_id, });
}

$("#btn_carrega").click(function() {
  $('#relatorios-faturas').html('Loading...');
 const data = prepara_data();
    if(data.status_id.length == 0){
       window.Toast.fire({icon: 'error', title: ' Selecione pelo menos 1 Status !'});
       return;
    }
 console.log(data);

 requisicao("{{route('relatorios-faturas')}}",'post', data)
      .then(result => {
        $('#relatorios-faturas').html(result);
     });



});


function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
@endsection