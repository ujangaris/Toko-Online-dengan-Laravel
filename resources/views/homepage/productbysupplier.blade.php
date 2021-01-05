@extends('homepage.layouts.frontMaster')


@section('content')
@include('homepage.layouts.partials.breadcrumb')
<div class="container">
    <div class="row bar">
        <div class="col-md-6">
            <table class="table table-bordered">
                    <tr>
                        <th width="150px;">Username</th>
                        <td>{{ $user->username }}</td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{ $user->address }}</td>
                    </tr>
                    <tr>
                        <th>Photo</th>
                        <td><img src="{{ url($user->photo) }}" width="70px;"></td>
                    </tr>
                    <tr>
                        <th>Tanggal bergabung</th>
                        <td>{{ date('d/m/Y', strtotime($user->photo)) }}</td>
                    </tr>

            </table>
        </div>
    </div>
</div>
<div class="container">
    <div class="row bar">
        <div class="col-md-12">
              <p class="text-muted lead text-center">Jual Komputer dan Gadget Terlengkap.</p>
              <div class="products-big">
                <div class="row products">
                    @foreach($products as $product)

                  <div class="col-lg-3 col-md-4">
                    <div class="product">
                      <div class="image"><a href="{{ url('product/detail/'.$product->slug) }}"><img src="{{ url($product->photo) }}" alt="" class="img-fluid image1"></a></div>
                      <div class="text">
                        <h3 class="h5"><a href="{{ url('product/detail/'.$product->slug) }}">{{ $product->name }}</a></h3>
                        <p class="price">Rp. {{ number_format($product->price,0,",",".") }}</p>
                      </div>
                    </div>
                  </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>


@endsection
