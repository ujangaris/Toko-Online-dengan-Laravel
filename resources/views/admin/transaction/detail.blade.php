@extends('admin.layouts.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box-body">
            <section class="invoice">
                <!-- title row -->
                <div class="row">
                    <div class="col-xs-12">
                    <h2 class="page-header">
                        <i class="fa fa-globe"></i> Detail Transaction
                        <small class="pull-right">Code: {{ $transaction->code }}</small>
                    </h2>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-3 invoice-col">
                        Nama
                    </div>
                    <div class="col-sm-9 invoice-col">
                        <strong>{{ $transaction->user->name }}</strong>
                    </div>
                    <div class="col-sm-3 invoice-col">
                        Alamat
                    </div>
                    <div class="col-sm-9 invoice-col">
                        <strong>{{ $transaction->user->address }}</strong>
                    </div>
                    <div class="col-sm-3 invoice-col">
                        Code
                    </div>
                    <div class="col-sm-9 invoice-col">
                        <strong>{{ $transaction->code }}</strong>
                    </div>
                </div>
                <br>
                <!-- /.row -->

                <!-- Table row -->
                <div class="row">
                    <div class="col-xs-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                        <th>No.</th>
                        <th>Product</th>
                        <th>Jumlah</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                                $no= 1;
                                $gt= 0;
                            @endphp
                            @foreach($transactiondetail as $td)

                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $td->product->name }}</td>
                                <td>{{ $td->qty }}</td>
                                <td>{{ number_format($td->subtotal,0,",",".") }}</td>
                                <td>{{ number_format($td->product->price,0,",",".") }}</td>
                            </tr>
                                @php
                                    $gt = $gt + $td->subtotal;
                                @endphp
                            @endforeach

                        </tbody>
                    </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row">
                    <!-- accepted payments column -->
                    <div class="col-xs-6">
                    <p class="lead">Payment Methods:</p>
                    <img src="../../dist/img/credit/visa.png" alt="Visa">
                    <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                    <img src="../../dist/img/credit/american-express.png" alt="American Express">
                    <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

                    <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg
                        dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                    </p>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-6">
                    <p class="lead">Amount Due 2/22/2014</p>

                    <div class="table-responsive">
                        <table class="table">
                        <tr>
                            <th style="width:50%">Subtotal:</th>
                            <td>Rp.{{ number_format($gt,0,",",".") }}</td>
                        </tr>
                        <tr>
                            <th>Ongkir:</th>
                            <td>{{ number_format($transaction->ekspedisi['Value'],0,",",".") }}</td>
                        </tr>
                        <tr>
                            <th>Grand Total:</th>
                            <td>{{ number_format($gt+$transaction->ekspedisi['Value'],0,",",".") }}</td>
                        </tr>
                        </table>
                    </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- this row will not appear when printing -->
                <div class="row no-print">
                    <div class="col-xs-12">
                    <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                    <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
                    </button>
                    <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
                        <i class="fa fa-download"></i> Generate PDF
                    </button>
                    </div>
                </div>
            </section>
    <!-- /.content -->
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
          <!-- DataTa-->
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