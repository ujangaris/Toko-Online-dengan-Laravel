@extends('homepage.layouts.frontMaster')


@section('content')
      <div id="heading-breadcrumbs">
        <div class="container">
          <div class="row d-flex align-items-center flex-wrap">
            <div class="col-md-7">
              <h1 class="h2">My Orders</h1>
            </div>
            <div class="col-md-5">
              <ul class="breadcrumb d-flex justify-content-end">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">My Orders</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div id="content">
        <div class="container">
          <div class="row bar mb-0">
            <div id="customer-orders" class="col-md-9">
              <p class="text-muted lead">Silahkan Lakukan Pembayaran melalui no Rekening 0123456789,Apabila sudah melalkukan pembayaran silahkan hubungi admin
                  <a href="https://api.whatsapp.com/send?phone=6281289671096&text=Haii%20sayangg" class="btn btn-success">Hubungi Admin</a>
                </p>
              <div class="box mt-0 mb-lg-0">
                <div class="table-responsive">
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
                                @foreach($category as $categorys)
                                    <option
                                    @if($categorys->id ==$product->category_id )
                                        selected = "selected"
                                    @endif
                                    value="{{ $categorys->id }}">{{ $categorys->name }}</option>
                                        @foreach($categorys->children as $sub)
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
            <div class="col-md-3 mt-4 mt-md-0">
              <!-- CUSTOMER MENU -->
              <div class="panel panel-default sidebar-menu">
                <div class="panel-heading">
                  <h3 class="h4 panel-title">Customer section</h3>
                </div>
                <div class="panel-body">
                  <ul class="nav nav-pills flex-column text-sm">
                    <li class="nav-item"><a href="customer-orders.html" class="nav-link active"><i class="fa fa-list"></i> My orders</a></li>
                    <li class="nav-item"><a href="customer-wishlist.html" class="nav-link"><i class="fa fa-heart"></i> My wishlist</a></li>
                    <li class="nav-item"><a href="customer-account.html" class="nav-link"><i class="fa fa-user"></i> My account</a></li>
                    <li class="nav-item"><a href="index.html" class="nav-link"><i class="fa fa-sign-out"></i> Logout</a></li>
                  </ul>
                </div>
              </div>
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
