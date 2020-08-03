
 <table id="aula_lista2" class="table table-bordered table-striped">
    <thead>
    <tr>
 
      <th>Aula</th>

    </tr>
    </thead>
    <tbody>
  
          @foreach (App\aulas::where('academia_id',auth()->user()->academia_id)->get() as $aula)
         <tr class="mao" onclick="aula_select({'id':'{{$aula->id}}','nome':'{{$aula->desc}}'})">
                 
                  <td>{{$aula->desc}}</td>

              </tr>
          @endforeach
   
    </tbody>

  </table>


  <script>
    $(function () {
      $("#aula_lista2").DataTable({
        "responsive": true,
        "autoWidth": false,
        "pageLength": 15
      });
    });  

      function aula_select(obj){
          console.log(obj);
           recebe_aula(obj);
          $('#modal').modal('hide');
      }     
 
       
 

</script>