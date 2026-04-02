@extends('admin.layouts.adminMaster')
@push('css')

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush
@section('content')
    @include('alerts.alerts')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header bg-success">
                <h3 class="card-title">Users</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#id</th>
                            <th>Action</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Created at</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>
                                    <div class="btn-group btn-sm">
                                        <form action="{{ route('users.destroy', ['user' => $user->id]) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button onclick="return confirm('Are you sure? You want to delete this user?')"
                                                type="submit" class="btn text-danger btn-xs"><i
                                                    class="fas fa-trash-alt fa-2x"></i></button>
                                        </form>
                                        <a href="{{ route('users.edit', ['user' => $user->id]) }}"
                                            class="btn text-warning btn-xs"><i class="far fa-edit fa-2x"></i></a>
                                    </div>
                                </td>
                                <td>
                                    @if ($user->provider_id)
                                    <img src="{{ $user->avatar }}" alt="Standard-News" srcset="" width="40px" height="40px">
                                    @else
                                        <img src="{{ route('imagecache', ['template' => 'sbixs', 'filename' => $user->avatar()]) }}"
                                            alt="{{ alt($user->avatar) }}" srcset="">
                                    @endif
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if (!empty($user->getRoleNames()))
                                        @foreach ($user->getRoleNames() as $v)
                                            <label class="badge badge-primary">{{ $v }}</label>
                                        @endforeach
                                    @endif
                                </td>
                                <td>{{ $user->created_at }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center h3 text-danger">No User Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#id</th>
                            <th>Action</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Created at</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endpush
