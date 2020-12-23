@extends('admin.layouts.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Category</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ route('category.update',$category->id) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('put') }}
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control"  placeholder="Enter Category" name="name" value="{{ $category->name }}">
                </div>
                <div class="form-group">
                  <label for="slug">Slug</label>
                  <input type="text" class="form-control"  placeholder="Enter Slug" name="slug" value="{{ $category->slug }}">
                </div>
                <div class="form-group">
                  <label for="icon">Icon</label>
                  <input type="text" class="form-control"  placeholder="Enter Icon" name="icon" value="{{ $category->icon }}">
                </div>
                <div class="form-group">
                    @if($category->parent_id == null)
                        <input type="hidden" name="parent_id" value="">
                    @else
                    <label for="parent_id">Parent Category</label>

                    <select name="parent_id" class="form-control">
                            @foreach($categorys as $cas)
                                <option value="{{ $cas->id }}"
                                    @if($cas->id == $category->parent_id)
                                        selected
                                    @endif
                                    >{{ $cas->name }}</option>
                            @endforeach
                        </select>
                      @endif
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
