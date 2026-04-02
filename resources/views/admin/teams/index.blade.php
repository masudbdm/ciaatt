@extends('admin.layouts.adminMaster')

@push('css')
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

<style>
    .drag-handle {
        cursor: move;
        text-align: center;
        width: 40px;
    }
</style>
@endpush

@section('content')
@include('alerts.alerts')

<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-primary ">
    <h3 class="card-title mb-0 text-white">
        <i class="fas fa-users mr-1"></i> Team Members
    </h3>
<div class="card-tools">
    <a href="{{ route('teams.create') }}"
       class="btn btn-outline-light btn-sm">
        <i class="fas fa-user-plus mr-1"></i> Add Member
    </a>
</div>
</div>


        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Order</th>
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

                <tbody id="sortable">
                    @forelse ($teams as $team)
                    <tr data-id="{{ $team->id }}">
                        {{-- Drag Handle --}}
                        <td class="drag-handle">
                            <i class="fas fa-arrows-alt"></i>
                        </td>

                        {{-- Action --}}
                        <td>
                            <div class="btn-group btn-sm">
                                <a href="{{ route('teams.edit', $team->id) }}"
                                   class="btn text-warning btn-xs">
                                    <i class="far fa-edit fa-lg"></i>
                                </a>

                                <form action="{{ route('teams.destroy', $team->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Delete this member?')"
                                            class="btn text-danger btn-xs">
                                        <i class="fas fa-trash-alt fa-lg"></i>
                                    </button>
                                </form>
                            </div>
                        </td>

                        {{-- Image --}}
                        <td>
                            @if($team->image)
                                <img src="{{ asset('storage/'.$team->image) }}"
                                     width="40" height="40"
                                     class="img-circle">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>

                        <td>{{ $team->name }}</td>
                        <td>{{ $team->designation }}</td>
                        <td>{{ $team->email }}</td>

                        <td>
                            <span class="badge badge-{{ $team->status ? 'success' : 'danger' }}">
                                {{ $team->status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>

                        <td>
                            <span class="badge badge-{{ $team->featured ? 'info' : 'secondary' }}">
                                {{ $team->featured ? 'Yes' : 'No' }}
                            </span>
                        </td>

                        <td>{{ $team->created_at->format('d M Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center text-danger h4">
                            No Team Member Found
                        </td>
                    </tr>
                    @endforelse
                </tbody>

                <tfoot>
                    <tr>
                        <th>Order</th>
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

{{-- jQuery UI for drag --}}
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

<script>
$(function () {

    // DataTable (ordering OFF)
    $('#example1').DataTable({
        responsive: true,
        paging: false,
        ordering: false,
        info: false
    });

    // Drag & Drop
    $('#sortable').sortable({
        handle: '.drag-handle',
        update: function () {

            let order = [];

            $('#sortable tr').each(function () {
                order.push($(this).data('id'));
            });

            $.ajax({
                url: "{{ route('teams.reorder') }}",
                type: "POST",
                data: {
                    order: order,
                    _token: "{{ csrf_token() }}"
                },
                success: function () {
                    toastr.success('Team order updated successfully');
                }
            });
        }
    });
});
</script>
@endpush
