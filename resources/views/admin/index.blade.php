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

        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>

@endsection
