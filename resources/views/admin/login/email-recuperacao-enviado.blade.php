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
            <h4>Email enviado com seucesso!</h4>
            <p> Em alguns instantes você receberá um e-mail com as instruções para restaurar sua senha.</h4>
    
      
          <p class="mb-1 mt-3 text-center">
            <a href="{{ route('login') }}">Entrar no sistema</a>
          </p>
 
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
    <!-- /.login-box -->

@endsection
