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
                <p class="lead">Order #1735 was placed on <strong>22/06/2013</strong> and is currently <strong>Being prepared</strong>.</p>
              <p class="lead text-muted">If you have any questions, please feel free to <a href="contact.html">contact us</a>, our customer service center is working for you 24/7.</p>
              <div class="box">
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th class="border-top-0">Qty</th>
                        <th class="border-top-0">Product</th>
                        <th class="border-top-0">Price</th>
                        <th class="border-top-0">Subtotal</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                            $gt= 0;
                        @endphp
                        @foreach($transactiondetail as $td)

                        <tr>
                            <td>{{ $td->qty }}</td>
                            <td>{{ $td->product->name }}</td>
                            <td>{{ number_format($td->product->price,0,",",".") }}</td>
                            <td>{{ number_format($td->subtotal,0,",",".") }}</td>
                        </tr>
                            @php
                                $gt = $gt + $td->subtotal;
                            @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <th colspan="3" class="text-right">Order subtotal</th>
                        <th>Rp. {{ number_format($td->subtotal,0,",",".") }}</th>
                      </tr>
                      <tr>
                        <th colspan="3" class="text-right">Ongkir</th>
                        <th>Rp. {{ number_format($transaction->ekspedisi['value'],0,",",".") }}</th>
                      </tr>
                      <tr>
                        <th colspan="3" class="text-right">Grand TOtal</th>
                        <th>Rp. {{ number_format($gt+$transaction->ekspedisi['value'],0,",",".") }}</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
                <div class="row addresses">
                  <div class="col-md-6 text-right">
                    <h3 class="text-uppercase">Pengirim</h3>
                    <p>
                        {{ $transaction->product->user->name }}<br>
                     {{ $transaction->product->user->address }}<br>
                    {{ $transaction->ekspedisi['name'] }} <br>
                     {{ $transaction->ekspedisi['etd'] }} day <br>
                    </p>
                  </div>
                  <div class="col-md-6 text-right">
                    <h3 class="text-uppercase">Penerima</h3>
                    <p>
                         {{ $transaction->name }}(<strong>{{ $transaction->user->name}})</strong><br>
                        {{ $transaction->address }}<br>
                        {{ $transaction->portal_code }}<br>
                        @if($transaction->status == 0)
                        Belum
                        @else
                        Lunas
                        @endif
                    </p>
                  </div>
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


