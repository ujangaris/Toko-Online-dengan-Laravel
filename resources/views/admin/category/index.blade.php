@extends('admin.layouts.master')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Category</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ url('admin/category') }}" method="POST">
                {{ csrf_field() }}
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control"  placeholder="Enter Category" name="name">
                </div>
                <div class="form-group">
                  <label for="slug">Slug</label>
                  <input type="text" class="form-control"  placeholder="Enter Slug" name="slug">
                </div>
                <div class="form-group">
                  <label for="icon">Icon</label>
                  <input type="text" class="form-control"  placeholder="Enter Icon" name="icon">
                </div>
                <div class="form-group">
                  <label for="parent_id">Parent Category</label>

                  <select name="parent_id" class="form-control">
                      <option value="">Select</option>
                      @foreach($categorys as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                      @endforeach
                  </select>
                </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
        </div>
          <!-- /.box -->

    </div>
    <div class="col-md-8">
        <!-- Default box -->
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Category</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Category</th>
                </tr>
                </thead>
                <tbody>

                @php
                    $no = 1;
                @endphp
                @foreach($categorys as $category)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $category->name }}
                        <ul>
                            @foreach($category->children as $subcategory)
                            <li>{{ $subcategory->name }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td><a href="{{ url('admin/category/'.$category->id.'/edit') }}">Edit</a>
                        <ul>
                            @foreach($category->children as $subcategory)
                            <li class="table_list" style="margin-left:-41px; list-style-type:none;"><a href="{{ url('admin/category/'.$subcategory->id.'/edit') }}">Edit</a></li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
                @endforeach
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
