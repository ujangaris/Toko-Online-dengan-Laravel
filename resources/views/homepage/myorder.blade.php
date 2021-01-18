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
                <a href="https://api.whatsapp.com/send?phone=6281289671096&text=Haii%20sayangg" class="btn btn-success">Hubungi Admin</a></p>
              <div class="box mt-0 mb-lg-0">
                <div class="table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Code</th>
                        <th>Member</th>
                        <th>Ekspedisi</th>
                        <th>Status</th>
                        <th>Menu</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                          $no = 1;
                      @endphp
                     @foreach($transaction as $transactions)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $transactions->code }}</td>
                            <td>{{ $transactions->user->name }}</td>
                            <td>{{ $transactions->ekspedisi['name'] }}</td>
                            <td>

                                @if($transactions->status == 0)
                                <a href="#" ><span class="badge badge-danger">Belum</span></a>
                                @else
                                <a href="#" ><span class="badge badge-success">Sudah</span></a>
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('cart/detail/'.$transactions->code) }}" class="btn btn-template-outlined btn-sm">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
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


