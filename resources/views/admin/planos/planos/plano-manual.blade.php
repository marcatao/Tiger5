Adicionar plano manualmente:
 @php
    $alunos = App\aluno::where('id',$id)->get();
  @endphp

<!--<form>-->
    <div class="row">
        <div class="col-md-3">
            <label>Aluno</label>
            <select class="form-control" name="aluno_id" id="aluno_id" readonly>
                @foreach ($alunos as $aluno)
                    <option value="{{$aluno->id}}">{{$aluno->nome}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label>Selecione o plano:</label>
            <select class="form-control" id="plano_id" name="plano_id">
                @foreach (App\planos::where('academia_id',auth()->user()->academia_id)->get() as $plano)
                    <option value="{{$plano->id}}">{{$plano->titulo_plano}} - (R$ {{number_format($plano->valor_plano,2,",",".")}})</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <label>Pagamento:</label>
            <select class="form-control" id="formapagamento_id" name="formapagamento_id">
                @foreach (App\FormaPagamento::all() as $pagamento)
                      <option value="{{$pagamento->id}}">{{$pagamento->descicao}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <label>Valor pago:</label>
            <input type="text" name="valor_pago" id="valor_pago" class="form-control" required>
        </div>
        <div class="col-md-2 mt-2">
       
            <button class="btn btn-primary btn-block mt-4" id="btn_post_plano">Salvar</button>
        </div>

    </div>
<!--</form>   -->

<div id="feed"></div>


<script src="{{asset('admin/plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
    
<script>
  $(function () {
        $('#valor_pago').inputmask('decimal', {
                'alias': 'numeric',
                'groupSeparator': ',',
                'autoGroup': true,
                'digits': 2,
                'radixPoint': ".",
                'digitsOptional': false,
                'allowMinus': false,
                'placeholder': ''
         });
    });

$('#btn_post_plano').click(function(e) {
    const aluno_id = $('#aluno_id').val();
    const plano_id = $('#plano_id').val();
    const formapagamento_id = $('#formapagamento_id').val();
    const valor_pago = $('#valor_pago').val();
    
  requisicao('{{route('post-plano')}}','GET', aluno_id, plano_id, formapagamento_id, valor_pago)
    .then(result => {
        plano_aluno();
        window.Toast.fire({icon: 'success', title: 'Plano registrado com seucesso!'});
    });
});   
</script>


