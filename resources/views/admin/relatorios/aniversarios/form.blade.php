@extends('layouts.admin')
@section('estilo')
<link rel="stylesheet" href="{{ asset('css/custon.css')}}">
 
@endsection


@section('conteudo')

<a href="#" onclick="printDiv('relatorios-aniversarios')" class="botao-canto bg-primary">
  <i class="fa fa-print" aria-hidden="true"></i>
</a>  

<div class="col-md-12 mt-2">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Aniversariantes, selecione o mês</h3>
      </div>
      <div class="card-body">
        
        
          <div class="row">
          <div class="col-md-6">
          <select class="form-control" id="mes" name="mes">
              <option value="01">Janeiro</option>
              <option value="02">Fevereiro</option>
              <option value="03">Março</option>
              <option value="04">Abril</option>
              <option value="05">Maio</option>
              <option value="06">Junho</option>
              <option value="07">Julho</option>
              <option value="08">Agosto</option>            
              <option value="09">Setembro</option>
              <option value="10">Outubro</option>
              <option value="11">Novembro</option>
              <option value="12">Dezembro</option>
          </select>
        </div>
        <div class="col-md-6">
          <button class="btn btn-primary btn-block" id="btn_carrega">Carregar</button>
        </div></div>
 
    


    

 
 
    <div id="relatorios-aniversarios"></form>
 

</div></div></div>
</div>
@endsection



@section('scripts')
<script>
  $(function () {
 
  });


function prepara_data(){
    const mes = $('#mes').val();
    return ({"mes":mes,});
}

$("#btn_carrega").click(function() {
 $('#relatorios-aniversarios').html('Loading...');
 const data = prepara_data();
 console.log(data);
 requisicao("{{route('relatorios-aniversarios')}}",'post', data)
      .then(result => {
        $('#relatorios-aniversarios').html(result);
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