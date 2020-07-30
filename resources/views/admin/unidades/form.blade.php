@extends('layouts.admin')

@section('estilo')


@endsection


@section('conteudo')
<div class="container-fluid">

    <br>
    <div class="card">
              <div class="card-header">
                <h3 class="card-title">Edição unidade</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
        
          @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif         


               <form method="POST" action="{{route('unidade-save',$id)}}">
                {{  csrf_field() }}
                <label>Titulo da unidade:</label>
                <input type="text" class="form-control" name="titulo" id="titulo" @isset($unidade) value="{{$unidade->titulo}}" @endisset required>
                <label>Sub titulo:</label>
                <input type="text" class="form-control" name="sub_titulo" id="sub_titulo" @isset($unidade) value="{{$unidade->sub_titulo}}" @endisset required>
                <label>Endereço linha 1:</label>
                <input type="text" class="form-control" name="end1" id="end1" @isset($unidade) value="{{$unidade->end1}}" @endisset required>
                <label>Endereço linha 2:</label>
                <input type="text" class="form-control" name="end2" id="end2" @isset($unidade) value="{{$unidade->end2}}" @endisset required>
                <label>Endereço linha 3:</label>
                <input type="text" class="form-control" name="end3" id="end3" @isset($unidade) value="{{$unidade->end3}}" @endisset required>
                <label>Whatsapp:</label>
                <input type="text" class="form-control" name="whats" id="whats" @isset($unidade) value="{{$unidade->whats}}" @endisset required>
                <label>responsavel:</label>
                <input type="text" class="form-control" name="responsavel" id="responsavel" @isset($unidade) value="{{$unidade->responsavel}}" @endisset required>
                <label>Instagran:</label>
                <input type="text" class="form-control" name="insta" id="insta" @isset($unidade) value="{{$unidade->insta}}" @endisset required>

                <button type="submit" class="btn btn-primary btn-block mt-3"> Salvar alterações</button>

               </form>
             

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->


</div>
@endsection

@section('scripts')

<script>
    $(function () {
        @isset($message)
        window.Toast.fire({
          icon: '{{$message['type']}}',
          title: ' {{$message['message']}}.'
        })
      @endisset


    });
  </script>
@endsection