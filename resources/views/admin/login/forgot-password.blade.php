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
          <p>Informe seu email cadastrado para receber as instruções e redefinir a senha:</p>
          <form method="POST" action="{{ route('forgot-password') }}">
            @csrf
            <div class="input-group mb-3">
              <input id="email" type="email" class="form-control  @error('email') is-invalid @enderror"  name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
              
              @isset($message)
               
                     <p class="text-danger mt-4">{{ $message }}</p>
                
              @endisset

            @error('email')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
            </div>


            <div class="row">

              <!-- /.col -->
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block"> Redefinir minha senha</button>
              </div>
              <!-- /.col -->
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
