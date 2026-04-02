@extends('home.layouts.pageMaster')

@push('meta')
    {{-- Post specific overrides only --}}
    <meta property="og:type" content="article">

    {{-- Optional: Facebook App ID --}}
    {{-- <meta property="fb:app_id" content="{{ $websiteParameter->fb_page_code }}"> --}}
@endpush

@push('css')
<style>
    .social-icon {
        font-size: 18px !important;
    }
</style>
@endpush
@section('content')



    <!-- -------- START PRE-FOOTER 1 w/ SUBSCRIBE BUTTON AND IMAGE ------- -->
    <section class="my-5 pt-5">
        <div class="container-fluid px-3">
            <div class="row">
                <div class="col-md-9 p-1">
    <div class="card">
        <div class="card-body p-3">

            {{-- Category (Top – keep as is) --}}
            <h5 class="w3-md font-weight-bold mb-2">
                <i class="fa fa-caret-right text-primary-wp"></i>
                <span class="text-primary-wp">Category:</span>
                @foreach ($post->categories as $category)
                    <a href="{{ route('user.categoryDetails', $category) }}"
                       class="badge bg-secondary-wp my-1">
                        {{ $category->name }}
                    </a>
                @endforeach
            </h5>

            {{-- Title --}}
            <h2 class="mb-3">{!! $post->title !!}</h2>

            {{-- Featured Image --}}
            <div class="mb-3 text-center">
                <img
                    src="{{ asset('storage/media/image/' . $post->fi()) }}"
                    alt="image"
                    class="img-fluid rounded w3-animate-zoom">
            </div>

            {{-- Post created date --}}
            <div class="mb-3 text-muted">
                <i class="fa fa-calendar"></i>
                {{ $post->created_at->format('d M Y') }}
            </div>

            {{-- Description --}}
            <div class="post-content w3-animate-opacity mb-4">
                {!! $post->description !!}
            </div>
@php
    $tags = $post->tags ?? [];
 
@endphp

@if(!empty($tags))
    <div class="mb-4">
        <strong>Tags:</strong>
        @foreach($tags as $tag)
            <span class="badge bg-secondary me-1">{{ $tag }}</span>
        @endforeach
    </div>
@endif


            {{-- Share Buttons (AddThis replacement) --}}
            <div class="mt-4">
                <strong>Share:</strong>
                <a target="_blank"
                   href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                   class="btn btn-sm btn-primary me-1">
                    <i class="fa-brands fa-facebook-f social-icon"></i>

                </a>

                <a target="_blank"
                   href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($post->title) }}"
                   class="btn btn-sm btn-info me-1">
                    <i class="fa-brands fa-x-twitter social-icon"></i>

                </a>

                <a target="_blank"
                   href="https://wa.me/?text={{ urlencode($post->title . ' ' . url()->current()) }}"
                   class="btn btn-sm btn-success me-1">
                    <i class="fa-brands fa fa-whatsapp social-icon"></i>
                </a>

                <a target="_blank"
                   href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}"
                   class="btn btn-sm btn-secondary">
                    <i class="fa-brands fa-linkedin-in social-icon"></i>

                </a>

                <i style="font-size: 28px !important;" class="fa-solid fa-print social-icon me-3 text-danger"
   role="button"
   title="Print"
   onclick="window.print()">
</i>

            </div>

        </div>
    </div>
</div>



                <div class="col-md-3 ms-auto">
                    {{-- <label class="m-0" for="">Posts</label> --}}
                    <ul class="list-group list-group-flush">
                        @foreach ($posts as $post)
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
    </section>
    <!-- -------- END PRE-FOOTER 1 w/ SUBSCRIBE BUTTON AND IMAGE ------- -->

@endsection
