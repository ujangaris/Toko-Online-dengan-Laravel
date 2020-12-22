@extends('admin.layouts.master')

@section('content')
    <!-- Default box -->
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Table With Full Features</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Category</th>
                  <th>Sub Category</th>
                  <th>Slug</th>
                </tr>
                </thead>
                <tbody>

                @php
                    $no = 1;
                @endphp
                @foreach($categorys as $category)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <ul>
                            @foreach($category->children as $subcategory)
                            <li>{{ $subcategory->name }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <ul>
                            @foreach($category->children as $subcategory)
                            <li>{{ $subcategory->slug }}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
                @endforeach
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
      <!-- /.box -->

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
