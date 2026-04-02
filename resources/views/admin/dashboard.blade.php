@extends('admin.layouts.adminMaster')

@section('content')

<div class="container-fluid">

    {{-- Page Title --}}
    <div class="row mb-3">
        <div class="col">
            <h3 class="mb-0">Admin Dashboard</h3>
            <small class="text-muted">Overview of your website</small>
        </div>
    </div>

    {{-- Summary Boxes --}}
    <div class="row">

        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalPosts }}</h3>
                    <p>Total Posts</p>
                </div>
                <div class="icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <a href="{{ route('admin.allPost') }}" class="small-box-footer">
                    View Posts <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $totalPages }}</h3>
                    <p>Total Pages</p>
                </div>
                <div class="icon">
                    <i class="fas fa-copy"></i>
                </div>
                <a href="{{ route('admin.pagesAll') }}" class="small-box-footer">
                    View Pages <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $totalCategories }}</h3>
                    <p>Categories</p>
                </div>
                <div class="icon">
                    <i class="fas fa-tags"></i>
                </div>
                <a href="{{ route('admin.allCategory') }}" class="small-box-footer">
                    View Categories <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $totalMessages }}</h3>
                    <p>Customer Messages</p>
                </div>
                <div class="icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <a href="{{ route('admin.contactUs') }}" class="small-box-footer">
                    View Messages <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

    </div>

    {{-- Recent Data --}}
    <div class="row">

        {{-- Latest Posts --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Latest Posts</h3>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @forelse($latestPosts as $post)
                            <li class="list-group-item">
                                {{ Str::limit($post->title, 50) }}
                                <span class="float-right text-muted">
                                    {{ $post->created_at->format('d M Y') }}
                                </span>
                            </li>
                        @empty
                            <li class="list-group-item text-muted">
                                No posts found
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        {{-- Latest Messages --}}
<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Latest Customer Messages</h3>
        </div>

        <div class="card-body p-0">
            <ul class="list-group list-group-flush">
                @forelse($latestMessages as $msg)
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between align-items-start">
                            <strong>{{ $msg->customer_name }}</strong>
                            <small class="text-muted">
                                {{ $msg->created_at->format('d M Y, h:i A') }}
                            </small>
                        </div>

                        <small class="text-muted d-block mt-1">
                            {{ Str::limit($msg->customer_message, 60) }}
                        </small>
                    </li>
                @empty
                    <li class="list-group-item text-muted text-center">
                        No messages found
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
</div>


    </div>

</div>

@endsection
