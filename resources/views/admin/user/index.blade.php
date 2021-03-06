@extends('admin.layouts.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Default box -->
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Product</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Photo</th>
                  <th>Name</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Address</th>
                  <th>Gender</th>
                  <th>Status</th>
                  <th>Role</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                    @php
                        $no=1;
                    @endphp
                    @foreach($user as $users)
                        <tr>
                            <td>{{ $users->id }}</td>
                            <td><img src="{{ $users->photo }}" width="50px;"></td>
                            <td>{{ $users->name }}</td>
                            <td>{{ $users->username }}</td>
                            <td>{{ $users->email }}</td>
                            <td>{{ $users->address }}</td>
                            <td>
                                @if($users->gender == 'L')
                                    Laki-laki
                                @else
                                    Perempuan
                                @endif
                            </td>
                            <td>@if($users->status == 0)
                                    <a href="{{ url('admin/user/status/'.$users->id) }}" class="badge bg-red">Tidak Aktif</a>
                                @else
                                    <a href="{{ url('admin/user/status/'.$users->id) }}" class="badge bg-green"> Aktif</a>
                                @endif
                            </td>
                            <td>{{ $users->role }}</td>
                            <td>
                                <a href="{{ url('admin/user/edit/'.$users->id) }}" class="btn btn-sm btn-warning btn-xs">Edit</a>
                                <a href="{{ url('admin/user/delete/'.$users->id) }}" class="btn btn-sm btn-danger btn-xs">Delete</a>
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
