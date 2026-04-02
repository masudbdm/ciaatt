@extends('home.layouts.pageMaster')
@push('meta')
<meta property="og:type" content="website">
@endpush
@section('content')

    <header class="bg-gradient-dark">
        <div class="page-header min-vh-75" style="background-image: url(' {{ asset('img/cover2.png') }} ');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center mx-auto my-auto">
                        <h1 class="text-white">{!! $page->page_title !!}</h1>
                        {{-- <p class="lead mb-4 text-white opacity-8">We’re constantly trying to express ourselves and actualize
                            our dreams. If you have the opportunity to play this game</p> --}}
                        {{-- <button type="submit" class="btn bg-white text-dark">Create Account</button> --}}
                        {{-- <h6 class="text-white mb-2 mt-5">Find us on</h6>
                        <div class="d-flex justify-content-center">
                            <a href="javascript:;"><i class="fab fa-facebook text-lg text-white me-4"></i></a>
                            <a href="javascript:;"><i class="fab fa-instagram text-lg text-white me-4"></i></a>
                            <a href="javascript:;"><i class="fab fa-twitter text-lg text-white me-4"></i></a>
                            <a href="javascript:;"><i class="fab fa-google-plus text-lg text-white"></i></a>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </header>
    {{-- {{$pageItems}} --}}

    @isset($pageItems)
        <div class="card card-body shadow-xl mx-3 mx-md-4 mt-n6">
            @foreach ($pageItems as $pageItem)
                {{-- <section class="pb-5 position-relative bg-gradient-dark mx-n3"> --}}
                <section class="pb-5 position-relative mx-n3">
                    <div class="container">
                        <div class="row mb-0">
                            <div class="col-md-8 text-start mb-5 mt-2">
                                <h3 class="text-black z-index-1 position-relative">{!! $pageItem->title !!}</h3>
                                {{-- <p class="text-black opacity-8 mb-0">There’s nothing I really wanted to do in life that I wasn’t
                                able to get good at. That’s my skill.</p> --}}
                            </div>
                        </div>

                        {!! $pageItem->content !!}
                    </div>
                </section>
            @endforeach
        </div>
    @endisset
@endsection
