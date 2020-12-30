@extends('admin.layouts.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Default box -->
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Transaction</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
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
                        $no =1;
                    @endphp
                    @foreach($transaction as $transactions)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $transactions->code }}</td>
                            <td>{{ $transactions->user->name }}</td>
                            <td>{{ $transactions->ekspedisi['name'] }}</td>
                            <td>

                                @if($transactions->status == 0)
                                <a href="{{ url('admin/transaction/'.$transactions->code.'/'.$transactions->status) }}" ><span class="badge bg-red">Belum</span></a>
                                @else
                                <a href="{{ url('admin/transaction/'.$transactions->code.'/'.$transactions->status) }}" ><span class="badge bg-green">Sudah</span></a>
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('admin/transaction/'.$transactions->code.'/detail/data') }}" class="btn btn-sm btn-primary">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
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
