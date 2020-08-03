@if(count($alunos) == 0)
    <div class="row text-center">
        <div class="col-md-12">
            <h3>Não existe alunos com creditos disponiveis para essa aula!</h3>
            <a href="{{route('cadastro-alunos')}}" class="text-center">Clique aqui para selecionar o aluno e adicionar créditos</a>

        </div>
    </div>
@else
 <table id="aluno_lista1" class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>Aluno</th>
        <th>Aluno</th>
        <th>e-mail</th>
    </tr>
    </thead>
    <tbody>
        
        @foreach ($alunos as $aluno)
             <tr class="mao" onclick="aluno_select({'id':'{{$aluno->aluno_id}}'})">
                  <td><img src="{{asset($aluno->Aluno->FotoPerfil)}}" class="profile-user-img img-fluid"></td>
                  <td>{{$aluno->Aluno->nome}}</td>
                  <td>{{$aluno->Aluno->email}}</td>
             </tr>
         @endforeach
   
    </tbody>

  </table>

  <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
  <script src="{{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
  <script src="{{asset('admin/plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
  
  <script>

    $(function () {
      $("#aluno_lista1").DataTable({
        "responsive": true,
        "autoWidth": false,
      });
    });  

      function aluno_select(obj){
           requisicao('{{route('chamada-aluno')}}','post','{{$chamada->id}}',obj.id)
           .then(result => {
            const r = $.parseJSON(result);
            console.log(r.aluno.id);
            $("#aluno_chamada_"+'{{$chamada->id}}').append(gera_linha(r.aluno,r.chamada_aluno_id));
          });
   
          $('#modal').modal('hide');
      }     
 
       
 function gera_linha(aluno,chamada_aluno_id){

  var newRow = $('<tr id="RowTable_'+ chamada_aluno_id +'">');	    
  var cols = "";	
      cols += '<td><img src="'+'{{asset('')}}'+aluno.foto+'" class="profile-user-img img-fluid"></td>';	    
      cols += '<td>'+aluno.nome +'</td>';	    
      cols += '<td>';	    
      cols += '<button class="btn btn-danger" onclick="deleteAlunoChamada('+chamada_aluno_id+')">'+
               '<i class="fas fa-trash"></i>'+
               '</button>';	    
      cols += '</td>';	
        
     return newRow.append(cols);	    
     
 }

</script>
@endif