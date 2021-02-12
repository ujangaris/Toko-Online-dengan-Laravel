
<!DOCTYPE html>
<html>
@include('admin.layouts.partials.head')
<body class="hold-transition skin-blue sidebar-mini">
    <!-- Sweet alert -->
<!-- Site wrapper -->
<div class="wrapper">

  @include('admin.layouts.partials.header')

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  @include('admin.layouts.partials.sidebar')

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Blank page
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      @yield('content')

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @include('admin.layouts.partials.footer')

  <!-- Control Sidebar -->
  {{-- @include('admin.layouts.partials.sidebar-control') --}}
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
        @include('sweetalert::alert')


@include('admin.layouts.partials.scripts')
</body>
</html>
