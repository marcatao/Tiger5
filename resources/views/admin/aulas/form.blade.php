@extends('layouts.admin')


@section('conteudo')
<div class="container-fluid">

    <br>
    <div class="card">
              <div class="card-header">
                <h3 class="card-title">Edição nome da Aula</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <form method="post" action="{{route('form-aula',$id)}}">
                    {{  csrf_field() }}
                    <input type="hidden" value="{{$id}}" id="id" name="id">
                    <label> Nome da aula </label>
                    <input type="text" class="form-control" name='desc' id='desc' @if($aula) value="{{$aula->desc}}" @endif required>
                    <label>Resumo</label>
                    <textarea class="form-control" id="resumo" name="resumo">@if($aula) {{$aula->resumo}} @endif </textarea><br>
                    <button type="submit" class="btn btn-primary btn-block"> Savlar </button>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->


</div>
@endsection

