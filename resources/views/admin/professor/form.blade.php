@extends('layouts.admin')


@section('conteudo')
<div class="container-fluid">

    <br>
    <div class="card">
              <div class="card-header">
                <h3 class="card-title">Edição Professor</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <form method="post" action="{{route('form-professor',$id)}}"  enctype="multipart/form-data">
                    {{  csrf_field() }}
                    <input type="hidden" value="{{$id}}" id="id" name="id">

                    <label>Selecione a pessoa</label>
                    <select name="user_id" id="user_id" class="form-control">
                        @foreach ($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>    
                        @endforeach
                    </select>
                    <label>Habilidades</label>
                    <input type="text" class="form-control" name='habilidades' id='habilidades' @if($professor) value="{{$professor->habilidades}}" @endif required>
                   
                    <label  class="control-label">Imagem</label>
                    <input type="file" name="file" id="file"  class="form-control" require><br>

                    <button type="submit" class="btn btn-primary btn-block"> Savlar </button>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->


</div>
@endsection


@section('scripts')

<script>
@if($professor)    
    $(function () {
         $('#user_id').val({{$professor->user_id}});
    });
@endif    
</script>
@endsection

