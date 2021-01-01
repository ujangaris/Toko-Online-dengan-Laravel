
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Laporan</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="box-body">
                <section class="invoice">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                        <h2 class="page-header">
                            <i class="fa fa-globe"></i> Detail Transaction
                            <small class="pull-right"><strong>Code:</strong> {{ $transaction->code }}</small>
                        </h2>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-md-6">
                            <div class="col-sm-2 invoice-col">
                                <strong>Pengirim</strong>
                            </div>
                            <div class="col-sm-9 invoice-col">
                                {{ $transaction->name }} (<strong>{{ $transaction->user->name }}</strong>)<br>
                                {{ $transaction->user->address }}

                            </div>
                            <div class="col-sm-2 invoice-col">
                                <strong>Penerima</strong>
                            </div>
                            <div class="col-sm-9 invoice-col">
                                {{ $transaction->user->name }} <br>
                                {{ $transaction->address }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-sm-2 invoice-col">
                                <strong>Ekspedisi</strong>
                            </div>
                            <div class="col-sm-9 invoice-col">
                                - {{ $transaction->ekspedisi['code'] }}<br>
                                - {{ $transaction->ekspedisi['etd'] }} Hari<br>
                                - {{ $transaction->ekspedisi['name'] }}
                            </div>
                            <div class="col-sm-2 invoice-col">
                                <strong>Status</strong>
                            </div>
                            <div class="col-sm-9 invoice-col">
                                @if ($transaction->status == 0)
                                    Belum Lunas
                                @else
                                    <strong class="badge bg-green">Lunas</strong>
                                @endif
                            </div>
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
                        <p class="lead">Rekening Bak</p>


                        <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                            Halaman ini merupakan halaman transaksi, pengiriman pembayaran dilakukan melalui rekening bank.
                        </p>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-6">
                            <div class="callout callout-info">
                            <p class="lead">Time : {{ date('d F Y, H:i',strtotime($transaction->created_at)) }}</p>
                            </div>

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


                </section>
        <!-- /.content -->
            </div>
        </div>
    </div>
</div>

</body>
</html>
