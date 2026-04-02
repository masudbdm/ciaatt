@extends('admin.layouts.adminMaster')
@push('css')

@endpush
@section('content')
    <div class="container-fluid">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">All Video Galleries</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" style="white-space: nowrap">
                        <thead>
                            <tr>
                                <th>Video</th>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($videoGalleries as $gallery)
                                @include('admin.gallery.video.parts.galleryItem')
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <div class="float-right">
                    {{ $videoGalleries->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')

@endpush
