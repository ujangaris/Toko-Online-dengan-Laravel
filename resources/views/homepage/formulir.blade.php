@extends('homepage.layouts.frontMaster')


@section('content')
<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row d-flex align-items-center flex-wrap">
        <div class="col-md-7">
            <h1 class="h2">Formulir Belanja</h1>
        </div>
        <div class="col-md-5">
            <ul class="breadcrumb d-flex justify-content-end">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active">Formulir Belanja</li>
            </ul>
        </div>
        </div>
    </div>
</div>
<div id="content">
    <div class="container">
        <div class="row bar">
        <div class="col-lg-12">
            <p class="text-muted lead">You currently have {{ Cart::count() }} item(s) in your cart.</p>
        </div>
        <div id="basket" class="col-lg-9">
            <div class="box mt-0 pb-0 no-horizontal-padding">

                <form method="post" action="{{ url('cart/transaction') }}">
                    {{ @csrf_field() }}
                  <ul class="nav nav-pills nav-fill">
                    <li class="nav-item"><a href="shop-checkout1.html" class="nav-link active"> <i class="fa fa-map-marker"></i><br>Address</a></li>
                    <li class="nav-item"><a href="#" class="nav-link disabled"><i class="fa fa-truck"></i><br>Delivery Method</a></li>
                    <li class="nav-item"><a href="#" class="nav-link disabled"><i class="fa fa-money"></i><br>Payment Method</a></li>
                    <li class="nav-item"><a href="#" class="nav-link disabled"><i class="fa fa-eye"></i><br>Order Review</a></li>
                  </ul>
                  <div class="content">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="name">Name (Member)</label>
                          <input  type="text" class="form-control" value="{{ Auth::user()->name }}" readonly >
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="email">Email (Member)</label>
                          <input  type="text" class="form-control" value="{{ Auth::user()->email }}" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="name">Name</label>
                          <input id="name" name="name" type="text" class="form-control" placeholder="Masukan Nama Penerima..">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="company">Kota / Alamat</label>
                          <select name="city" class="form-control" onchange="check()" id="city" >
                              @php
                                  $city = city();
                                  $city = json_decode($city,true);
                              @endphp
                              @foreach($city['rajaongkir']['results'] as $citys)
                              <option value="{{ $citys['city_id'] }}">{{ $citys['city_name'] }}</option>

                              @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="company">Provinsi</label>
                            <input  name="address" type="text" class="form-control" value="" id="provinsi" readonly>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-6 col-md-4">
                                <div class="form-group">
                                <label for="portal_code">Kode POS</label>
                                <input id="portal_code" name="portal_code" type="number" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-8">
                                <div class="form-group">
                                <label for="city"  >Ekspedisi</label>
                                <select name="eks" class="form-control">
                                    <option value="jne">Jalur Nugraha Ekakurir (JNE)</option>
                                    <option value="pos">POS Indonesia (POS)</option>
                                    <option value="tiki">Citra Van Titipan Kilat (TIKI)</option>
                                </select>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="box-footer d-flex flex-wrap align-items-center justify-content-between">
                    <div class="left-col"><a href="shop-basket.html" class="btn btn-secondary mt-0"><i class="fa fa-chevron-left"></i>Back to basket</a></div>
                    <div class="right-col">
                      <button type="submit" class="btn btn-template-main">Continue to Delivery Method<i class="fa fa-chevron-right"></i></button>
                    </div>
                  </div>
                </form>
            </div>
        </div>
        <div class="col-lg-3">
            <div id="order-summary" class="box mt-0 mb-4 p-0">
            <div class="box-header mt-0">
                <h3>Order summary</h3>
            </div>
            <p class="text-muted">Shipping and additional costs are calculated based on the values you have entered.</p>
            <div class="table-responsive">
                <table class="table">
                <tbody>
                    <tr>
                    <td>Order subtotal</td>
                    <th>$446.00</th>
                    </tr>
                    <tr>
                    <td>Shipping and handling</td>
                    <th>$10.00</th>
                    </tr>
                    <tr>
                    <td>Tax</td>
                    <th>$0.00</th>
                    </tr>
                    <tr class="total">
                    <td>Total</td>
                    <th>$456.00</th>
                    </tr>
                </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('scripts')

<script>
    function check(){
        /* var id= $('#city').val();
        alert(id)//menampilkan id dengan allert */
        var id = $('#city').val();
        $.ajax({
            type:"GET",
            url : "{{ url('citybyid/') }}/"+id,
            dataType    :"JSON",
            success     : function(data){
                // console.log(data);
                $("#provinsi").val(data.rajaongkir.results.province)
                $("#portal_code").val(data.rajaongkir.results.postal_code)
            }
        });
    }
</script>

@endpush
