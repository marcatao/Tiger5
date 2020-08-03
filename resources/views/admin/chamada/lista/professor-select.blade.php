
 <table id="professor_lista" class="table table-bordered table-striped">
    <thead>
    <tr>
      <th> </th>
      <th>Nome</th>
      <th>Habilidades</th>
    </tr>
    </thead>
    <tbody>
  
          @foreach (App\professor::where('academia_id',auth()->user()->academia_id)->get() as $professor)
         <tr class="mao" onclick="selectProf({'id' :'{{$professor->id}}','nome':'{{$professor->user->ShortName}}'})" >
                  <td><img src="{{asset($professor->foto)}}" class="profile-user-img img-fluid"></td>
                  <td>{{$professor->user->name}}</td>
                  <td>{{$professor->habilidades}}</td>
              </tr>
          @endforeach
   
    </tbody>

  </table>


  <script>
   function selectProf(obj){
        recebe_professor(obj);
        console.log(obj);
        $('#modal').modal('hide');
}
    $(function () {
      $("#professor_lista").DataTable({
        "responsive": true,
        "autoWidth": false,
        "pageLength": 5,
      });
    });


</script>