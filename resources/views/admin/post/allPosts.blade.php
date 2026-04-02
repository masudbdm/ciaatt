@extends('admin.layouts.adminMaster')
@push('css')

@endpush
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    All Posts
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" style="white-space: nowrap">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Action</th>
                                <th>Title</th>
                                <th>Excerpt</th>
                                <th>Image</th>
                                <th>Tags</th>
                                <th>Categories</th>
                                <th>Subcategories</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($posts as $post)
                                <tr>

                                    <td>{{ $post->id }}</td>
                                    <td>
                                        <div class="btn-group btn-sm pull-right ">
                                            <a class="btn btn-primary btn-xs"
                                                href="{{ route('admin.editPost',$post) }}">Edit</a>
                                            <button type="button" class="btn btn-primary btn-xs dropdown-toggle"
                                                data-toggle="dropdown">
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li> <a href="{{ route('admin.viewPost',$post->slug) }}" >Details</a></li>
                                                
                                            </ul>
                                        </div>


                                    </td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ mb_substr($post->excerpt, 0, 30) }}</td>
                                    <td>{{ $post->feature_img_name }}</td>
                                    <td>
                                        @if ($post->tags)
                                            @foreach ($post->tags as $item)
                                                <span class="badge badge-info">{{ $item }}</span>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @if ($post->categories)
                                            @foreach ($post->categories as $item)
                                                <span class="badge badge-success">{{ $item->name }}</span>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @if ($post->subcategories)
                                            @foreach ($post->subcategories as $item)
                                                <span class="badge badge-warning">{{ $item->name }}</span>
                                            @endforeach
                                        @endif
                                    </td>
                                </tr>
                            @empty

                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')

@endpush
