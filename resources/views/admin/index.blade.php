@extends('layouts.admin')
@section('conteudo')


    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Painel de Controle</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">



          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{count($alunos)}}</h3>

              <p>Alunos Ativos</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{route('cadastro-alunos')}}" class="small-box-footer">Mais detalhes <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
     
 

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{number_format($faturas->sum('valor_pago'),2,',','.')}}</h3>

                <p>Valores pagos neste mês</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{route('relatorios-faturas')}}" class="small-box-footer">
                Valores atrasados: {{number_format($faturas->where('valor_pago','0')->where('status_id',6)->sum('valor_plano'),2,',','.')}}
                
                <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>


          <!-- ./col -->
        </div>
        <!-- /.row -->

        <div class="row">

          <div class="col-md-4">
            <!-- USERS LIST -->
            <div class="card">
              <div class="card-header text-center">
                <h3 class="card-title text-center"> <i class="fas fa-birthday-cake"></i> - Proximos aniversariantes.</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <ul class="users-list clearfix">
                  @foreach ($aniversariantes as $a)
                  @php
                    $aluno = App\aluno::find($a->id);
                  @endphp
                  <a href="{{route('edicao-alunos',$a->id)}}">
                    <li>
                    <img src="{{$aluno->FotoPerfil}}" alt="FotoPerfil">
                       <a class="users-list-name">{{$aluno->nome}}</a>
                       <span class="users-list-date">@if($aluno->dt_nacito) {{date('d/m/Y', strtotime($aluno->dt_nacito))}} @endif</span>
                    </li>
                  </a>
                  @endforeach

                </ul>
                <!-- /.users-list -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-center">
                <a href="{{route('relatorios-aniversarios')}}">Lista de aniversariantes</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!--/.card -->
          </div>

        </div>

        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>

@endsection
