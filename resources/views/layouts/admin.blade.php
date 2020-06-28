<!DOCTYPE html>
<html>

@include('layouts.head')


<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  
  <!-- /.navbar -->
@include('admin.menus.superior')
@include('admin.menus.lateral')
<div class="content-wrapper">
 @yield('conteudo')
</div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2020-2021 <a href="http://adminlte.io">Tiger5.com.br</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> Beta
    </div>
  </footer>

</div>
<!-- ./wrapper -->

@include('layouts.scripts')

</body>
</html>
