
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin_index')}}" class="brand-link text-center">
      <span class="brand-text font-weight-light">Tiger 5</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('admin/dist/img/avatar5.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ ucfirst(trans(Auth::user()->ShortName)) }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        @if(Auth::user()->profile_id == 0)  
          <li class="nav-header">Gerenciamento</li>
          <li class="nav-item">
            <a href="{{ route('unidade-lista') }}" class="nav-link">
              <i class="nav-icon fas fa-building"></i>
              <p>Unidades</p>
            </a>
          </li>    

           <li class="nav-item">
            <a href="{{ route('cadastro-aula') }}" class="nav-link">
              <i class="nav-icon fas fa-boxes"></i>
              <p>Aulas</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('professor') }}" class="nav-link">
              <i class="nav-icon fas fa-graduation-cap"></i>
              <p>Professores</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('grade-aula') }}" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>Grade horários</p>
            </a>
          </li>   
          
          <li class="nav-item">
            <a href="{{ route('cadastro-alunos') }}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>Alunos</p>
            </a>
          </li> 

          <!-- <li class="nav-item">
            <a href="{{ route('cadastro-login') }}" class="nav-link">
              <i class="nav-icon fas fa-key"></i>
              <p>Login's</p>
            </a>
          </li> -->
          <li class="nav-item">
            <a href="{{ route('cadastro-planos') }}" class="nav-link">
              <i class="nav-icon fas fa-bullseye"></i>
              <p>Planos</p>
            </a>
          </li>                

          <li class="nav-item">
            <a href="{{ route('chamada-index') }}" class="nav-link">
              <i class="nav-icon fas fa-address-book"></i>
              <p>Lista presença</p>
            </a>
          </li> 


          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Relatórios
                <i class="fas fa-angle-left right"></i>
               
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="{{route('relatorios-faturas')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Mensalidades</p>
                </a>
              </li>
            </ul>
          </li>




          @endif

          <li class="nav-header">SISTEMA</li>
          <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
              <i class="nav-icon fas fa-door-open"></i>
              <p>Sair</p>
            </a>
          </li>

          <li class="nav-header"> </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
