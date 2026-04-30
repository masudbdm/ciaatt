@extends('home.layouts.pageMaster')
@push('meta')
<meta property="og:type" content="website">
@endpush
@section('content')
    <div class="container-fluid mt-5 mx-0">
        <div class="row">
            {{-- <div class="mb-4 w-100 w-md-50 w-lg-25"> --}}
            <div class="mb-4">
                <nav class="w-100 w-md-50 w-lg-20" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('user.welcome') }}">
                                Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Category</li>
                    </ol>
                </nav>
                <h3>{{ $category->name }}</h3>
                @if ($category->subcats->isNotEmpty())
                    <div class="d-flex flex-wrap align-items-center gap-1 mb-2">
                        @foreach ($category->subcats as $subcat)
                            <a href="{{ route('user.subcategoryDetails', $subcat) }}"
                                class="btn btn-sm btn-outline-primary me-1 mb-1">{{ $subcat->name }}</a>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="col-md-8 px-0">
                <div class="card">
                    {{-- <div class="container-fluid border-bottom py-2">
                        <div class="col-lg-3 me-auto px-1">
                            <p class="lead text-dark pt-1 mb-0">{{ $category->name }}</p>
                        </div>

                    </div> --}}
                    <div class="tab-content tab-space card-body">
                        <div class="tab-pane active" id="preview-features-1">
                            <!-- -------- START Features w/ icons and text on left & gradient title and text on right -------- -->
                
                     
                                    <div class="row">
                                        @foreach ($posts as $post)
                                            {{-- <div class="col-lg-4 col-md-4 my-2 w3-animate-zoom">
                                                <div class="card p-2" style="height: 350px;">
                                                    <div class="card-header p-0 mb-0">
                                                        <div class="d-flex justify-content-center align-items-center"
                                                            style="height: 180px;">
                                                            <img class="img-fluid"
                                                                src="{{ asset('storage/media/image/' . $post->fi()) }}"
                                                                style="max-height: 100%">
                                                        </div>
                                                    </div>
                                                    <div class="card-body pt-0 pl-1 mt-0">
                                                        <h6>{{ Str::limit($post->title, 20, '...') }}</h6>
                                                        <p class="m-0">{!! Str::limit($post->excerpt, 55, '...') !!}</p>
                                                    </div>
                                                    <div class="card-footer pt-0">
                                                        <a href="{{ route('user.postDetails', $post) }}"
                                                            class="text-primary icon-move-right">Read more
                                                            <i class="fas fa-arrow-right text-sm ms-1"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div> --}}
                                            <div class="col-md-3 col-6">
                                                <div class="card elevation-2 mb-3">
                                                    <a href="{{ route('user.postDetails', [$post,Str::slug($post->title)]) }}">
                                                    <img class="card-img-top"
                                                        src="{{ route('imagecache', ['template' => 'cplg', 'filename' => $post->fi()]) }}"
                                                        alt="Card image cap">
                                                    </a>
                                                    <div class="card-body p-1">
                                                        <h4 class="card-title w3-large w3-small">{{ Str::limit($post->title, 15, '...') }}</h4>
                                                        <p class="card-text w3-small">{{ Str::limit($post->excerpt, 50, '..') }}
                                                            <br>
                                                            <a href="{{ route('user.postDetails', [$post,Str::slug($post->title)]) }}" class="text-primary icon-move-right">
                                                                <span class="text-bold">Read more</span> 
                                                                <i class="fas fa-arrow-right text-sm ms-1"></i>
                                                            </a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                      
                      
                            <!-- -------- END Features w/ icons and text on left & gradient title and text on right -------- -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 ms-auto">
                {{-- <label class="m-0" for="">Posts</label> --}}
                <ul class="list-group list-group-flush">
                    @foreach ($postsForRightSidebar as $post)
                        <li class="list-group-item mx-0 px-0">
                            <a href="{{ route('user.postDetails', [$post,Str::slug($post->title)]) }}">
                                <div class="card">
                                    <div class="card-body p-1">
                                        <div class="row d-flex justify-content-center align-items-center">
                                            <div class="col-4 pl-0">
                                                <img src="{{ route('imagecache', ['template' => 'cpmd', 'filename' => $post->fi()]) }}" alt=""
                                                    class="img-fluid rounded" style="">
                                            </div>
                                            <div class="col-8 p-1">
                                                <div class="" >
                                                    <span class="text-bold"
                                                        style="font-size: 1.0 em;">{!! Str::limit($post->title, 45, '...') !!}</span>
                                                    <br>
                                                    <span style="font-size: 15px;">{!! Str::limit($post->excerpt, 25, '...') !!}</span>
                                                    <br>
                                                    <span class="">Read more</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

@endsection
