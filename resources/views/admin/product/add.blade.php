@extends('admin.layouts.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Product</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ url('admin/product') }}" method="POST" enctype="multipart/form-data">
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
                      <label for="description">Description</label>
                      <textarea id="editor" class="form-control"  name="description" rows="3"></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label for="stock">Stock</label>
                  <input type="number" class="form-control"  placeholder="Enter Stock" name="stock">
                </div>
                <div class="form-group">
                  <label for="price">Price</label>
                  <input type="number" class="form-control"  placeholder="Enter Price" name="price">
                </div>
                <div class="form-group">
                  <label for="parent_id">Parent Category</label>
                  <select name="category_id" class="form-control">
                      <option value="">Select</option>
                      @foreach($categorys as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @foreach($category->children as $sub)
                                <option value="{{ $sub->id }}"> - {{ $sub->name }}</option>
                            @endforeach
                      @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="photo">Photo</label>
                  <input type="file" class="form-control" name="file">
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
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



    <!-- CKeditor -->

<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script>
    var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    };
</script>
<script>
    CKEDITOR.replace('editor', options);
</script>



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
