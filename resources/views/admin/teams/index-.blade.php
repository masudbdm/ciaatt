@extends('admin.layouts.adminMaster')

@push('css')
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('content')
@include('alerts.alerts')

<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-success">
            <h3 class="card-title">Team Members</h3>
            <div class="card-tools">
                <a href="{{ route('teams.create') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-plus"></i> Add Member
                </a>
            </div>
        </div>

        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Action</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Featured</th>
                        <th>Created</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($teams as $team)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <div class="btn-group btn-sm">
                                <a href="{{ route('teams.edit', $team->id) }}"
                                   class="btn text-warning btn-xs">
                                   <i class="far fa-edit fa-2x"></i>
                                </a>

                                <form action="{{ route('teams.destroy', $team->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Delete this member?')"
                                            class="btn text-danger btn-xs">
                                        <i class="fas fa-trash-alt fa-2x"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                        <td>
                            @if($team->image)
                                <img src="{{ asset('storage/'.$team->image) }}" width="40" height="40" class="img-circle">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>
                        <td>{{ $team->name }}</td>
                        <td>{{ $team->designation }}</td>
                        <td>{{ $team->email }}</td>
                        <td>
                            <span class="badge badge-{{ $team->status ? 'success':'danger' }}">
                                {{ $team->status ? 'Active':'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-{{ $team->featured ? 'info':'secondary' }}">
                                {{ $team->featured ? 'Yes':'No' }}
                            </span>
                        </td>
                        <td>{{ $team->created_at->format('d M Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center text-danger h4">No Team Member Found</td>
                    </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Action</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Featured</th>
                        <th>Created</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script>
$(function () {
    $("#example1").DataTable({
        responsive: true,
        autoWidth: false,
        buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
});
</script>
@endpush
