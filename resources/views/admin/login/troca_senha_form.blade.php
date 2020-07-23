@extends('layouts.app')

@section('content')



<body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="../../index2.html"><b>{{ env('APP_NAME')}}</b></a>
      </div>
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body login-card-body">
          <p class="text-center">Coloque sua nova senha:</p>
          <form id="form-senha" method="POST" action="{{ route('password-update') }}">
            @csrf
            
            <input type="hidden" name="token" id="token" value="{{$token}}">

            <div class="input-group mb-3">
              <input id="pw1" name="pw1" type="password" class="form-control"  autofocus placeholder="Nova senha..." required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
                <input id="pw2" type="password" class="form-control"  autofocus placeholder="Repita senha..." required>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
  

            <div class="row">
              <div class="col-12">
                <button type="button" class="btn btn-primary btn-block" onclick="confere()"> Redefinir minha senha</button>
              </div>
            </div>
          </form>
    
             <!-- /.social-auth-links -->
    
          <p class="mb-1 mt-3 text-center">
            <a href="{{ route('login') }}">Entrar no sistema</a>
          </p>
         <!-- <p class="mb-0">
            <a href="{{ route('register') }}" class="text-center">Criar minha conta</a>
          </p>-->
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
    <!-- /.login-box -->

@endsection


@section('scripts')
<script>
function confere(){
    let pw1 = $('#pw1').val();
    let pw2 = $('#pw2').val();
    if((pw1.length < 5) || (pw2.length < 5) || pw1 != pw2){
        alert('as senhas devm ter mais que 5 caracteres, e serem iguais');
        exit();
    }
    $('#form-senha').submit();
 
}
</script>
@endsection
