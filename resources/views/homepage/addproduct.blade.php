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
                  <table class="table table-hover">
                    <form role="form" action="{{ url('addproduct') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control"  placeholder="Enter Name Product" name="name">
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
                  <label for="weight">Weight</label>
                  <input type="number" class="form-control"  placeholder="Enter Weight" name="weight">
                </div>
                <div class="form-group">
                  <label for="parent_id">Parent Category</label>
                  <select name="category_id" class="form-control">
                      <option value="">Select</option>
                      @foreach($category as $categorys)
                        <option value="{{ $categorys->id }}">{{ $categorys->name }}</option>
                            @foreach($categorys->children as $sub)
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
                  </table>
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
