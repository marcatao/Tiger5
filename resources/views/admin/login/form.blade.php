@extends('layouts.admin')


@section('conteudo')
<div class="container-fluid">

 @if($errors)

 @endif
    <br>
    <div class="card">
              <div class="card-header">
                <h3 class="card-title">Cadastro/Edição de Login</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <form method="post" action="{{route('create-login')}}"  enctype="multipart/form-data">
                    {{  csrf_field() }}
                    
                    <input type="hidden" class="form-control" id="id" name="id" @if($user) value="{{$user->id}}" @endif  placeholder="Informe Nome completo..." required>
                         <div class="form-group">
                            <label for=>Nome </label>
                            <input type="text" class="form-control" id="name" name="name" @if($user) value="{{$user->name}}"  @endif  placeholder="Informe Nome completo..." required>
                         </div>
                         <div class="form-group">
                            <label for=>Email</label>
                            <input type="email" class="form-control" id="email" name="email" @if($user) value="{{$user->email}}" readonly @endif placeholder="informe o principal email..." required>
                         </div>
                         <div class="form-group">
                            <label>Profile</label>
                            <select class="form-control" name="profile_id" id="profile_id">
                                @isset($profiles)
                                    @foreach ($profiles as $profile)
                                         <option value="{{$profile->id}}">{{$profile->desc}}</option>
                                    @endforeach
                                @endisset
                                
                            </select>
                         </div>
                         @if(!$user) 
                          <hr>
                         <div class="form-group">
                            <label for=>Senha</label>
                            <input type="password" class="form-control" id="senha" name="senha" placeholder="senha..." required>
                         </div>                      
                         <div class="form-group">
                            <label for=>Confirmar senha</label>
                            <input type="password" class="form-control" id="senha_confirma" name="senha_confirma" placeholder="senha confirma..." required>
                         </div>                      
                         @endif
    
    


                    <input type="submit" class="btn btn-primary btn-block" value="Salvar alterações">
                  </form>  
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->


</div>
@endsection


@section('scripts')
<script src="{{asset('admin/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('admin/plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
<script>
 


$(function () {
@if($user)
   $('#profile_id').val({{$user->profile_id}});
@endif
@isset($message)
    window.Toast.fire({
        icon: '{{$message['type']}}',
        title: ' {{$message['message']}}.'
      })
@endisset      
});

 



</script>
@endsection

