@extends('home.layouts.authorMaster')

@push('meta')
<meta property="og:type" content="profile">
<meta name="author" content="{{ $team->name }}">
@endpush

@push('css')
<style>
    .glass-icon {
        width: 38px;
        height: 38px;
        border-radius: 12px;
        background: rgba(255,255,255,0.25);
        backdrop-filter: blur(10px);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #344767;
        margin-right: 8px;
        transition: all 0.3s ease;
    }
    .glass-icon:hover {
        background: #344767;
        color: #fff;
        transform: translateY(-2px);
    }
</style>
@endpush

@section('content')

{{-- HEADER --}}
<header>
    <div class="page-header min-height-400"
         style="background-image: url('{{ asset('img/city-profile.jpg') }}');">
        <span class="mask bg-gradient-dark opacity-6"></span>
    </div>
</header>

{{-- PROFILE CARD --}}
<div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-n6 mb-4">
    <section class="py-5 position-relative">
        <div class="container">
            <div class="row">
                <div class="col-12 mx-auto">

                    {{-- Avatar --}}
                    <div class="text-center mt-n8">
                        <img class="avatar avatar-xxl shadow-xl position-relative z-index-2"
                             src="{{ $team->image ? asset('storage/'.$team->image) : asset('img/user-placeholder.png') }}"
                             alt="{{ $team->name }}">
                    </div>

                    {{-- Info --}}
                    <div class="row py-5">
                        <div class="col-lg-7 col-md-8 mx-auto text-center">

                            <h3 class="mb-0">{{ $team->name }}</h3>
                            <p class="text-info mb-1">{!! $team->designation !!}</p>

                            @if($team->qualification)
                                <p class="text-sm text-muted mb-2">
                                    {{ $team->qualification }}
                                </p>
                            @endif

                            {{-- Meta Info --}}
                            <div class="row justify-content-center my-3">
                                @if($team->location)
                                <div class="col-auto">
                                    <i class="fas fa-map-marker-alt text-sm"></i>
                                    <span class="text-sm">{{ $team->location }}</span>
                                </div>
                                @endif

                                @if($team->age)
                                <div class="col-auto">
                                    <i class="fas fa-user text-sm"></i>
                                    <span class="text-sm">{{ $team->age }} yrs</span>
                                </div>
                                @endif

                                <div class="col-auto">
                                    <i class="fas fa-venus-mars text-sm"></i>
                                    <span class="text-sm text-capitalize">{{ $team->gender }}</span>
                                </div>
                            </div>

                            {{-- BIO --}}
                            @if($team->bio)
                                <p class="text-lg mt-3">
                                    {!!  $team->bio  !!}
                                </p>
                            @endif

                            {{-- CONTACT --}}
                            <div class="mt-4">
                                @if($team->email)
                                    <p class="mb-1">
                                        <i class="fas fa-envelope me-1"></i>
                                        <a href="mailto:{{ $team->email }}">{{ $team->email }}</a>
                                    </p>
                                @endif

                                @if($team->phone)
                                    <p class="mb-0">
                                        <i class="fas fa-phone me-1"></i>
                                        {{ $team->phone }}
                                    </p>
                                @endif
                            </div>

                            {{-- SOCIAL --}}
                            @if(is_array($team->social_links))
                                <div class="mt-4">
                                    @foreach($team->social_links as $key => $link)
                                        @if($link)
                                            <a href="{{ $link }}" target="_blank" class="glass-icon">
                                                <i class="fab fa-{{ $key }}"></i>
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
                            @endif

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>

{{-- OPTIONAL CTA / CONTACT --}}
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h4>Want to connect with {{ $team->name }}?</h4>
                <p class="text-muted">
                    Feel free to reach out via email or social platforms.
                </p>
                @if($team->email)
                <a href="mailto:{{ $team->email }}" class="btn bg-gradient-info">
                    Send Email
                </a>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection
