@extends('admin.layouts.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Default box -->
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Product</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Photo</th>
                  <th>Product</th>
                  <th>Stock</th>
                  <th>user</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                    @php
                        $no= 1;
                    @endphp
                    @foreach($product as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td><img src="{{ url($item->photo) }}" height="50px;"></td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->stock }}</td>
                            <td>{{ $item->user->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
      </div>
    </div>
</div>


@endsection

{{-- Data table --}}
@push('styledataTable')
    <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('/static/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endpush

@push('scripts')
          <!-- DataTables -->
<script src="{{ asset('/static/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/static/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
@endpush
