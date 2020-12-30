@extends('admin.layouts.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Product</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('put') }}
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control"  placeholder="Enter Category" name="name" value="{{ $product->name }}">
                </div>
                <div class="form-group">
                  <label for="slug">Slug</label>
                  <input type="text" class="form-control"  placeholder="Enter Slug" name="slug" value="{{ $product->slug }}">
                </div>
                <div class="form-group">
                      <label for="description">Description</label>
                      <textarea id="editor" class="form-control"  name="description" rows="3">{{ $product->description }}</textarea>
                  </div>
                <div class="form-group">
                  <label for="stock">Stock</label>
                  <input type="number" class="form-control"  placeholder="Enter Stock" name="stock" value="{{ $product->stock }}">
                </div>
                <div class="form-group">
                  <label for="price">Price</label>
                  <input type="number" class="form-control"  placeholder="Enter Price" name="price" value="{{ $product->price }}">
                </div>
                <div class="form-group">
                  <label for="weight">Weight</label>
                  <input type="number" class="form-control"  placeholder="Enter weight" name="weight" value="{{ $product->weight }}">
                </div>
                <div class="form-group">
                  <label for="parent_id">Parent Category</label>
                  <select name="category_id" class="form-control">
                      <option value="">Select</option>
                      @foreach($categorys as $category)
                        <option
                        @if($category->id ==$product->category_id )
                            selected = "selected"
                        @endif
                        value="{{ $category->id }}">{{ $category->name }}</option>
                            @foreach($category->children as $sub->id)
                                <option
                                @if($sub->id ==$product->category_id)
                                        selected = "selected"
                                @endif
                                value="{{ $sub->id }}"> - {{ $sub->name }}</option>
                            @endforeach
                      @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="photo">Photo</label>
                  <div class="row">
                      <div class="col-md-6">
                          <input type="file" class="form-control" name="file">
                        </div>
                        <div class="col-md-6">
                            <img src="{{ url($product->photo) }}" width="150px;">
                            <input type="hidden" name="tmp_image" value="{{ $product->photo }}">
                        </div>
                    </div>
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
