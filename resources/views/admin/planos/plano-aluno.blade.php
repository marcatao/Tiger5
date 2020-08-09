@include('admin.planos.planos.plano-manual')
<hr>

<div class="row">
    <div class="col-md-12">
      <div class="card card-primary card-tabs">
        <div class="card-header p-0 pt-1">
          <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="aulas-plano-tab" data-toggle="pill" href="#aulas-plano" role="tab" aria-controls="aulas-plano" aria-selected="true">Planos do Aluno</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" id="aulas-abertas-tab" data-toggle="pill" href="#aulas-abertas" role="tab" aria-controls="custom-tabs-one-home" aria-selected="false"  onclick=" carrega_abela('1','aulas-abertas');">Aulas em aberto</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="aulas-fechadas-tab" data-toggle="pill" href="#aulas-fechadas" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false" onclick="carrega_abela('0','aulas-fechadas')">Aulas encerradas</a>
            </li>
          </ul>
        </div>
        <div class="card-body">
          <div class="tab-content" id="custom-tabs-one-tabContent">

            <div class="tab-pane fade show active" id="aulas-plano" role="tabpanel" aria-labelledby="aulas-plano-tab">
              Loading  aulas-plano...
            </div>
            
            <div class="tab-pane fade show" id="aulas-abertas" role="tabpanel" aria-labelledby="aulas-abertas-tab">
              Loading aulas abertas...
            </div>
            <div class="tab-pane fade" id="aulas-fechadas" role="tabpanel" aria-labelledby="aulas-fechadas-tab">
              Loading aulas fechadas... 
            </div>

          </div>
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>




<script>
    $(function () {
      carrega_plano_maula_aluno();
    });   

function carrega_plano_maula_aluno(){
  console.log('admin.planos.planos.maula-aluno');
    requisicao('{{route('lista-planos-aluno',$id)}}','get',status)
    .then(result => {
        $('#aulas-plano').html(result);
    });
}
function carrega_abela(status,div){
  console.log('admin.planos.planos.tabela-plano');
    requisicao('{{route('lista-aulas-aluno',$id)}}','get',status)
    .then(result => {
        $('#'+div).html(result);
    });
}
</script>
