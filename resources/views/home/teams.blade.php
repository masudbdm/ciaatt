@extends('home.layouts.pageMaster')

@push('meta')
<meta property="og:type" content="website">
@endpush

@push('css')
<style>
    .glass-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: rgba(255,255,255,0.25);
        backdrop-filter: blur(10px);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #344767;
        margin-right: 6px;
        transition: all 0.3s ease;
    }

    .glass-icon:hover {
        background: #344767;
        color: #fff;
        transform: translateY(-2px);
    }

    .team-card {
        transition: all .3s ease;
    }

    .team-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 40px rgba(0,0,0,.15);
    }
</style>
@endpush

@section('content')

{{-- Header --}}
<header class="bg-gradient-dark">
    <div class="page-header min-vh-75" style="background-image: url('{{ asset('img/bg9.jpg') }}');">
        <span class="mask bg-gradient-dark opacity-8"></span>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center mx-auto my-auto">
                    <h1 class="text-white">Our Team</h1>
                </div>
            </div>
        </div>
    </div>
</header>

{{-- Team Section --}}
@isset($teams)
<div class="card card-body shadow-xl mx-3 mx-md-4 mt-n6 py-5">

    <section class="pb-5 position-relative bg-light mx-n3 mb-5 mt-4">
        <div class="container">

            <div class="row">
                <div class="col-md-8 text-start mb-5 mt-5">
                    <h3 class="text-dark position-relative">Our Team</h3>
                    <p class="text-dark opacity-8 mb-0">
                        Meet the minds behind magic
                    </p>
                </div>
            </div>

            <div class="row">
                @foreach($teams as $team)
                <div class="col-lg-6 col-12 mb-4 mt-4 d-flex">

                    <div class="card card-profile team-card h-100 w-100 mt-4">
                        <div class="row h-100">

                            {{-- Image --}}
                            <div class="col-lg-4 col-md-5 col-12 mt-n5">
                                <div class="p-3 pe-md-0">
                                    <img
                                        class="w-100 border-radius-md shadow-lg"
                                        src="{{ $team->image ? asset('storage/'.$team->image) : asset('img/user-placeholder.png') }}"
                                        alt="{{ $team->name }}">
                                </div>
                            </div>

                            {{-- Info --}}
                            <div class="col-lg-8 col-md-7 col-12 my-auto">
                                <div class="card-body ps-lg-0 d-flex flex-column h-100">

                                    <div>
                                        <h5 class="mb-0 text-dark">{{ $team->name }}</h5>
                                        <h6 class="text-info mb-2">{!! $team->designation !!}</h6>

                                        @if($team->qualification)
                                            <p class="mb-2 text-sm">
                                                {{ Str::limit($team->qualification, 120) }}
                                            </p>
                                        @endif
                                    </div>

                                    {{-- Footer --}}
                                    <div class="mt-auto">
    <div class="row align-items-center">

        {{-- Left: Social Icons --}}
        <div class="col-12 col-md-6 mb-2 mb-md-0">
            @if(is_array($team->social_links))
                <div class="team-social d-flex
                    justify-content-center justify-content-md-start">

                    @foreach (['facebook'=>'facebook-f','twitter'=>'twitter','linkedin'=>'linkedin-in'] as $key=>$icon)
                        @if(!empty($team->social_links[$key]))
                            <a href="{{ $team->social_links[$key] }}"
                               target="_blank"
                               class="glass-icon">
                                <i class="fab fa-{{ $icon }}"></i>
                            </a>
                        @endif
                    @endforeach

                </div>
            @endif
        </div>

        {{-- Right: Profile Button --}}
        <div class="col-12 col-md-6 text-center text-md-end">
            <a href="{{ route('team.show', $team->username) }}"
               class="btn btn-sm btn-outline-info rounded-pill px-3">
                View Profile
            </a>
        </div>

    </div>
</div>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                @endforeach
            </div>

        </div>
    </section>

</div>
@endisset

@endsection
