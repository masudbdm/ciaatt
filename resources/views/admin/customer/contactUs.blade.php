@extends('admin.layouts.adminMaster')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Customer Messages</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Customer Messages</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<div class="row">
    <div class="col-12">

        {{-- Copy Button --}}
        <div class="mb-2">
            <button class="btn btn-primary btn-sm" onclick="copyTableData()">
                <i class="fas fa-copy"></i> Copy Current Page
            </button>
        </div>

        <div class="card">
            <div class="card-body table-responsive p-0">

                <table class="table table-hover text-nowrap" id="customerTable">
                    <thead>
                        <tr>
                            <th width="50">ID</th>
                            <th>Customer Name</th>
                            <th>Customer Email</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th width="80">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($customersMessage as $customerMessage)
                            <tr>
                                <td>{{ $customerMessage->id }}</td>
                                <td>{{ $customerMessage->customer_name }}</td>
                                <td>{{ $customerMessage->customer_email }}</td>
                                <td>{{ $customerMessage->customer_message }}</td>
                                <td>{{ $customerMessage->created_at->format('d M Y, h:i A') }}</td>
                                <td>
                                    <form action="{{ route('admin.contactUs.delete', $customerMessage->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this message?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">
                                    No customer messages found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>

            {{-- Pagination --}}
            <div class="card-footer clearfix">
                {{ $customersMessage->links() }}
            </div>

        </div>
    </div>
</div>

@endsection


@push('js')
<script>
function copyTableData() {
    let table = document.getElementById("customerTable");
    let range = document.createRange();
    range.selectNode(table);

    window.getSelection().removeAllRanges();
    window.getSelection().addRange(range);

    try {
        document.execCommand("copy");
        alert("Customer messages copied successfully!");
    } catch (err) {
        alert("Copy failed!");
    }

    window.getSelection().removeAllRanges();
}
</script>
@endpush
