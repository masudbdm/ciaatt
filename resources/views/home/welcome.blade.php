@extends('home.layouts.master')
@push('css')


    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Raleway:wght@300;400;500;600;700&family=Playfair+Display:wght@700&display=swap"
        rel="stylesheet">
    {{-- <!-- <link rel="stylesheet" href="https://dotlines.com.sg/vendor/cms-template/dotlines/css/animate.css"> --> --}}
    {{-- <link rel="stylesheet" href="https://dotlines.com.sg/vendor/cms-template/dotlines/css/style.css?v=1"> --}}

    <style>
        .owl-dot {
            display: none !important;
        }

        element.style {
            margin-bottom: 3px;
        }

        /* .attachment-block {
                border: 1px solid #f4f4f4;
                padding: 5px;
                margin-bottom: 10px;
                background: #f7f7f7;
            } */

        /* .attachment-block .attachment-pushed {
                margin-left: 110px;
            } */
        }

        /* .attachment-block .attachment-img {
                max-width: 100px;
                max-height: 100px;
                height: auto;
                float: left;
            } */


            .page-header {
    position: relative;
    min-height: 75vh;
    width: 100%;
}

/* Video fix */
.bg-video {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    z-index: 0;
}

/* Overlay */
.video-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.20); /* চাইলে কম-বেশি করুন */
    z-index: 1;
}

/* Content above video */
.z-2 {
    z-index: 2;
}

.page-header {
    position: relative;
    z-index: 1;
}

.page-header video,
.page-header .video-overlay {
    z-index: 1;
}

.card.card-body.blur {
    position: relative;
    z-index: 10;
    background-color: #ffffff;
}

@media (max-width: 767px) {
    .video-overlay {
        background: rgba(0, 0, 0, 0.05); /* অথবা completely off */
        /* display: none;  <-- চাইলে পুরো disable */
    }
}

.w3-border-green {
    border-color: {{ $websiteParameter->primary_color }} !important;
}
.border-success- {
    border-color: {{ $websiteParameter->primary_color }} !important;
}

.text-success- {
    color: {{ $websiteParameter->primary_color }} !important;
}
.text-second{
    color: {{ $websiteParameter->secondary_color }} !important;

}

    </style>

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

 
/* Animated dark glowing welcome box */

.welcome-box-animated{
    width: 100%;
    max-height: 100px;
    position: relative;
    overflow: hidden;

    background: rgba(30,30,30,0.35);
    backdrop-filter: blur(8px);

    display: flex;
    align-items: center;
    justify-content: center;

    animation: welcomeFloat 5s ease-in-out infinite;
}

/* Moving inner glow */
.welcome-box-animated::before{
    content: "";
    position: absolute;

    width: 160px;
    height: 250%;

    top: -100%;
    left: -200px;

    background: linear-gradient(
        90deg,
        transparent,
        rgba(255,255,255,0.4),
        rgba(255,255,255,0.1),
        transparent
    );

    animation: welcomeGlowMove 10s linear infinite;
}

/* Text layer */
.welcome-box-animated a{
    position: relative;
    z-index: 2;
    color: black !important;
    line-height: 1.2;
}

/* Floating animation */
@keyframes welcomeFloat{
    0%,100%{
        transform: translateY(0px);
    }
    50%{
        transform: translateY(-2px);
    }
}

/* Glow movement */
@keyframes welcomeGlowMove{
    from{
        left: -200px;
    }
    to{
        left: 100%;
    }
}



/* ===============================
   Glass Spark Animated Card
================================*/
.glass-card{
    position: relative;
    height: 120px;
    border-radius: 18px;
    overflow: hidden;

    backdrop-filter: blur(14px);

    /* 🔥 Animated Glass Background */
    background: linear-gradient(
        120deg,
        rgba(255,255,255,0.75),
        rgba(240,248,255,0.65),
        rgba(255,255,255,0.75)
    );
    background-size: 200% 200%;
    animation: glassFlow 8s ease-in-out infinite;

    transition: all 0.35s ease;

    box-shadow:
        0 10px 30px rgba(0,0,0,0.06);
}

/* Hover Lift */
.glass-card:hover{
    transform: translateY(-6px) scale(1.02);
    box-shadow:
        0 20px 50px rgba(0,0,0,0.15);
}

/* Spark Shine Sweep */
.glass-card::before{
    content:"";
    position:absolute;
    top:0;
    left:-150%;
    width:60%;
    height:100%;

    background: linear-gradient(
        120deg,
        transparent,
        rgba(255,255,255,0.85),
        transparent
    );

    animation: sparkMove 5s linear infinite;
}

/* 🔥 DARKER PREMIUM BORDER */
.glass-card::after{
    content:"";
    position:absolute;
    inset:0;
    border-radius:18px;
    padding:2px;

    background: linear-gradient(
        45deg,
        rgba(0,120,255,0.8),
        rgba(0,255,200,0.8),
        rgba(90,0,255,0.8)
    );

    -webkit-mask:
        linear-gradient(#fff 0 0) content-box,
        linear-gradient(#fff 0 0);

    -webkit-mask-composite: xor;
            mask-composite: exclude;

    animation: borderGlow 5s ease-in-out infinite;
}

/* Content Layer */
.glass-card .card-body{
    position: relative;
    z-index: 2;
}

/* Animations */
@keyframes sparkMove{
    0%{ left:-150%; }
    100%{ left:150%; }
}

@keyframes borderGlow{
    0%,100%{ opacity:0.7; }
    50%{ opacity:1; }
}

/* 🔥 Background Flow Animation */
@keyframes glassFlow{
    0%{ background-position: 0% 50%; }
    50%{ background-position: 100% 50%; }
    100%{ background-position: 0% 50%; }
}

/* ================================
   NEON QUANTUM CARD
=================================*/

.neon-card{
    position: relative;
    height: 120px;
    border-radius: 20px;
    overflow: hidden;
    cursor: pointer;

    background: rgba(255,255,255,0.65);
    backdrop-filter: blur(14px);

    transition: all .35s ease;
}

/* Depth lift */
.neon-card:hover{
    transform: translateY(-8px) scale(1.03);
}

/* Quantum Neon Border */
.neon-card::before{
    content:"";
    position:absolute;
    inset:-2px;
    border-radius:20px;

    background: linear-gradient(
        45deg,
        #00f0ff,
        #00ff9d,
        #7a00ff,
        #00f0ff
    );

    background-size:300% 300%;
    animation: quantumFlow 6s linear infinite;

    z-index:0;
}

/* Inner mask */
.neon-card::after{
    content:"";
    position:absolute;
    inset:2px;
    border-radius:18px;
    background: rgba(255,255,255,0.75);
    z-index:1;
}

.neon-card .card-body{
    position:relative;
    z-index:2;
}

@keyframes quantumFlow{
    0%{background-position:0% 50%;}
    50%{background-position:100% 50%;}
    100%{background-position:0% 50%;}
}

.neon-card{
    --x:50%;
    --y:50%;
}

.neon-card:hover{
    background:
      radial-gradient(
        circle at var(--x) var(--y),
        rgba(0,255,255,0.35),
        transparent 60%
      ),
      rgba(255,255,255,0.7);
}

.spark{
    position:absolute;
    width:4px;
    height:4px;
    border-radius:50%;
    background:#00f0ff;
    pointer-events:none;
    animation: sparkFloat 2s linear forwards;
}

@keyframes sparkFloat{
    0%{
        opacity:1;
        transform: translateY(0) scale(1);
    }
    100%{
        opacity:0;
        transform: translateY(-40px) scale(0.5);
    }
}


</style>


@endpush
@section('content')
    <header class="header-2 mb-4">

        @if($websiteParameter->hero_type === 'image' && $websiteParameter->featured_image)
    {{-- <img src="{{ asset($websiteParameter->featuredImage()) }}"
         width="1200" height="340"
         alt="Featured Image"> --}}

         <div class="page-header min-vh-75 relative"
            style="background-image: url({{ asset($websiteParameter->featuredImage()) }});">
            <span class="mask- bg-gradient-primary opacity-4"></span>


            <div class="container">

                <div class="row">
                    <div class="col-lg-7 text-center mx-auto">
                        <div class="row align-items-center">
   
                        </div>
 
                    </div>
                </div>


            </div>
        </div>
@elseif($websiteParameter->hero_type === 'video' && $websiteParameter->featured_video)
   

    <div class="page-header min-vh-75 position-relative overflow-hidden">

    <!-- Background Video -->
    <video
        autoplay
        muted
        loop
        playsinline
        class="bg-video">
        <source src="{{ asset($websiteParameter->featuredVideo()) }}" type="video/mp4">
    </video>

    <!-- Overlay -->
    <div class="video-overlay"></div>

    <!-- Content -->
    <div class="container position-relative z-2">
        <div class="row">
            <div class="col-lg-7 text-center mx-auto">
             
            </div>
        </div>
    </div>

</div>


@endif
 

    </header>

    <div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-n5">

        <div class="text-center">

            <h1 class="welcome-box-animated p-2 w3-small mt-2 w3-round" style="background-color: rgba(65, 65, 65, 0.2);">
                <a href="" class="typewrite w3-large text-bolder" data-period="1000" style="color:black;"
                    data-type='[ {{ $websiteParameter->welcome_page_msg }} ]'>
                    <span class="wrap"></span>
                </a>


            </h1>

        </div>

        @php
            $servicesFrontTitle = $websiteParameter->home_services_front_title
                ?: 'Touch Here <br /> To see our services';
            $servicesFrontText = $websiteParameter->home_services_front_text
                ?: 'Discover our comprehensive range of services designed to meet your unique needs.';

            $servicesBackTitle = $websiteParameter->home_services_back_title ?: 'Why Choose CIAATT?';
            $servicesBackText = $websiteParameter->home_services_back_text
                ?: 'You will save a lot of time going from End-to-end QA solutions from pre-production to shipment.';
            $servicesBackButtonText = $websiteParameter->home_services_back_button_text ?: 'Start to know more';
            $servicesBackButtonLinkRaw = $websiteParameter->home_services_back_button_link
                ?: route('user.pageDetails', ['url' => 'our-services', 'page' => 10]);
            $servicesBackButtonLink = preg_match('~^https?://~i', $servicesBackButtonLinkRaw)
                ? $servicesBackButtonLinkRaw
                : url($servicesBackButtonLinkRaw);

            $servicesRight1Title = $websiteParameter->home_services_right_1_title
                ?: 'CIAATT <br>Pre-Production Services';
            $servicesRight1Text = $websiteParameter->home_services_right_1_text ?: "Raw Material Inspection (fabrics, trims, chemicals)\nCountry of Origin Verification (fabrics & trims)\nFactory Readiness Check\nSupplier Assessment & Capability Audit\nPP Sample Approval & Verification";
            $servicesRight1LinkText = $websiteParameter->home_services_right_1_link_text;
            $servicesRight1LinkRaw = $websiteParameter->home_services_right_1_link;
            $servicesRight1Link = !empty($servicesRight1LinkRaw)
                ? (preg_match('~^https?://~i', $servicesRight1LinkRaw) ? $servicesRight1LinkRaw : url($servicesRight1LinkRaw))
                : null;

            $servicesRight2Title = $websiteParameter->home_services_right_2_title
                ?: 'Specialized Testing Services';
            $servicesRight2Text = $websiteParameter->home_services_right_2_text ?: "Lab Testing (safety, flammability, chemicals, performance)\nPerformance & Durability Testing\nSustainability & Environmental Verification (Oeko-Tex, GOTS)\nShrinkage/Durability Checks,\nPacking & Hangtag Verification,";
            $servicesRight2LinkText = $websiteParameter->home_services_right_2_link_text;
            $servicesRight2LinkRaw = $websiteParameter->home_services_right_2_link;
            $servicesRight2Link = !empty($servicesRight2LinkRaw)
                ? (preg_match('~^https?://~i', $servicesRight2LinkRaw) ? $servicesRight2LinkRaw : url($servicesRight2LinkRaw))
                : null;
        @endphp

        <section class="my-5 py-2">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 ms-auto me-auto p-lg-4 mt-lg-0 mt-4">
                        <div class="rotating-card-container">
                            <div
                                class="card card-rotate card-background card-background-mask-primary shadow-primary mt-md-0 mt-5">
                                <div class="front front-background"
                                    style="background-image: url(https://images.unsplash.com/photo-1569683795645-b62e50fbf103?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=987&q=80); background-size: cover;">
                                    <div class="card-body py-7 text-center">
                                        <i class="material-icons text-white text-4xl my-3">touch_app</i>
                                        <h3 class="text-white">{!! $servicesFrontTitle !!}</h3>
                                        <p class="text-white opacity-8">{!! nl2br(e($servicesFrontText)) !!}</p>
                                    </div>
                                </div>
                                <div class="back back-background"
                                    style="background-image: url(https://images.unsplash.com/photo-1498889444388-e67ea62c464b?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1365&q=80); background-size: cover;">
                                    <div class="card-body pt-7 text-center">
                                        <h3 class="text-white">{!! $servicesBackTitle !!}</h3>
                                        <p class="text-white opacity-8">{!! nl2br(e($servicesBackText)) !!}</p>
                                        <a href="{{ $servicesBackButtonLink }}"
                                            class="btn btn-white btn-sm w-50 mx-auto mt-3">{{ $servicesBackButtonText }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 ms-auto">
                        <div class="row justify-content-start">
                            <div class="col-md-12">
                                <div class="info">
                                    <i class="material-icons text-gradient text-primary text-3xl">content_copy</i>
                                    <h5 class="font-weight-bolder mt-3">{!! $servicesRight1Title !!}</h5>
                                    <p class="pe-5">{!! nl2br(e($servicesRight1Text)) !!}
                                        @if(!empty($servicesRight1Link) && !empty($servicesRight1LinkText))
                                            <br>
                                            <a href="{{ $servicesRight1Link }}">{{ $servicesRight1LinkText }}</a>
                                        @endif
                                    </p>
                                    
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="info">
                                    <i class="material-icons text-gradient text-primary text-3xl">flip_to_front</i>
                                    <h5 class="font-weight-bolder mt-3">{!! $servicesRight2Title !!}</h5>
                                    <p class="pe-3">{!! nl2br(e($servicesRight2Text)) !!}
                                        @if(!empty($servicesRight2Link) && !empty($servicesRight2LinkText))
                                            <br>
                                            <a href="{{ $servicesRight2Link }}">{{ $servicesRight2LinkText }}</a>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                         
                    </div>
                </div>
            </div>
        </section> 

 


        <section class="mb-3">
            <div class="row">
                @foreach ($categoriesPost as $category)
                    <div class="col-md-4 col-12">
                        <a href="{{ route('user.categoryDetails', $category) }}" class="text-primary icon-move-right">
                            <div class="glass-card elevation-2 mb-3 mx-2 border-1 border-success-" style="height: 130px">
                                <div class="card-body p-1">
                                    <h4 class="card-title w3-large text-center font-weight-bold text-success- ">
                                        {{ Str::limit($category->name, 20, '...') }}</h4>
                                    <p class="card-text text-justify px-4 w3-text-black">
                                        {{ Str::limit($category->description_en, 85, '...') }}
                                        <br>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
        {{-- End Categories --}}
 
 
        <hr>

        <!-- Set up your HTML -->

        <!-- -------- START Content Presentation Docs ------- -->
        {{-- <div class="container mt-sm-5">
            <div class="page-header py-6 py-md-5 my-sm-3 mb-3 border-radius-xl"
                style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/desktop.jpg');"
                loading="lazy">
                <span class="mask bg-gradient-dark"></span>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 ms-lg-5">
                            <h4 class="text-white">Built by developers</h4>
                            <h1 class="text-white">Complex Documentation</h1>
                            <p class="lead text-white opacity-8">From colors, cards, typography to complex elements,
                                you will find the full documentation. Play with the utility classes and you will create
                                unlimited combinations for our components.</p>
                            <a href="https://www.creative-tim.com/learning-lab/bootstrap/overview/material-kit"
                                class="text-white icon-move-right">
                                Read docs
                                <i class="fas fa-arrow-right text-sm ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        {{-- post --}}
        <div class="row mb-5">
            @foreach ($categoriesPost as $category)
                <div class="col-sm-6">
                    <div class="card card-widget mb-2">
                        <div class=" w3-panel w3-leftbar w3-border-green">
                            <h3 class="card-title">
                                <a href="{{ route('user.categoryDetails',$category)}}">{{ $category->name }}</a>
                            </h3>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-sm-6">
                                    @foreach ($category->posts as $post)
                                        @if ($loop->index == 0)
                                            <a class="text-muted mb-1"
                                                href="{{ route('user.postDetails', [$post,Str::slug($post->title)]) }}">
                                                <img class="img-responsive" width="100%"
                                                    src="{{ route('imagecache', ['template' => 'cpmd', 'filename' => $post->fi()]) }}"
                                                    alt="">
                                                <div class="w3-container w3-light-gray">
                                                    <p style="font-weight: bold;font-size: 16px;">
                                                        {{ Str::limit($post->title, 40) }}</p>
                                                    <p class="text-justify" style="line-height:1.2">
                                                        {{ Str::limit(strip_tags($post->description), 120, '...') }}

                                                    </p>
                                                </div>
                                            </a>
                                        @endif
                                    @endforeach
                                </div>

                                
                                <div class="col-sm-6">
                                    @foreach ($category->posts->take(6) as $post)
                                        @if ($loop->index > 1)
                                            
                                                <div class="row py-1 my-1 w3-hover-opacity border-bottom ">
                                                   
                                                    <div class="col-sm-4 col-4">
                                                        <a
                                                            href="{{ route('user.postDetails', [$post,Str::slug($post->title)]) }}">
                                                            <img class="" style=""
                                                                src="{{ route('imagecache', ['template' => 'ppmd', 'filename' => $post->fi()]) }}"
                                                                alt="">
                                                        </a>

                                                    </div>
                                                    <div class="col-sm-8 col-8">
                                                        <h4 class=""
                                                            style="font-size: 14px;line-height: 1.3;">
                                                            <a
                                                                href="{{ route('user.postDetails', [$post,Str::slug($post->title)]) }}"> {{ Str::limit($post->title, 50, '...') }}</a>

                                                        </h4>
                                                    </div>
                                                </div>


                                            
                                        @endif
                                    @endforeach

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>






        {{-- <section>
            <div class="container px-0 mt-2">

                <div class="row">
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="card p-0 m-0 rounded-0">
                                <div class="card-header p-0 m-0">
                                    <h4 class="w3-leftbar w3-border-red">Category Name</h4>
                                </div>
                                <div class="card-body p-0 m-0">
                                    <div class="col-sm-6">
                                        <div class="card p-0 m-0" style="">
                                            <img class="card-img-top" src="..." alt="Card image cap">
                                            <div class="card-body">
                                              <h5 class="card-title">Card title</h5>
                                              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                              <a href="#" class="btn btn-primary">Go somewhere</a>
                                            </div>
                                          </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="contents bg-primary my-2">
                                            <div class="row">
                                            <div class="img col-4">
                                                lorem10
                                            </div>
                                            <div class="content col-8">
                                                <p>Lorem ipsum dolor s</p>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="contents bg-primary my-2">
                                            <div class="row">
                                            <div class="img col-4">
                                                lorem10
                                            </div>
                                            <div class="content col-8">
                                                <p>Lorem ipsum dolor s</p>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="contents bg-primary my-2">
                                            <div class="row">
                                            <div class="img col-4">
                                                lorem10
                                            </div>
                                            <div class="content col-8">
                                                <p>Lorem ipsum dolor s</p>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="contents bg-primary my-2">
                                            <div class="row">
                                            <div class="img col-4">
                                                lorem10
                                            </div>
                                            <div class="content col-8">
                                                <p>Lorem ipsum dolor s</p>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="contents bg-primary my-2">
                                            <div class="row">
                                            <div class="img col-4">
                                                lorem10
                                            </div>
                                            <div class="content col-8">
                                                <p>Lorem ipsum dolor s</p>
                                            </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section> --}}

        {{-- post --}}

        {{-- All posts --}}



@if($websiteParameter->front_team_show)
        @isset($featured_teams)

       <div class="container">
    <div class="row">
        <div class="col-lg-6 col-10 mx-auto">
            <div class="text-center mb-4">
                <h3 class="text-dark position-relative mb-1 w3-xxlarge">
                    Our Team
                </h3>
                <p class="text-dark mb-3">
                    <b>Meet the minds behind magic</b>
                </p>

                {{-- CTA Button --}}
                <a href="{{ url('/teams') }}"
                   class="btn btn-outline-dark btn-sm px-4 rounded-pill">
                    View Full Team
                </a>
            </div>
        </div>
    </div>
</div>


<section class="py-sm-3"  >
    <div class="bg-gradient-dark position-relative  border-radius-xl overflow-hidden">

        {{-- SVG Background --}}
        <img
            src="{{ asset('img/waves-white.svg') }}"
            alt="pattern-lines"
            class="position-absolute top-0 start-0 w-100 h-100 opacity-2"
            style="object-fit: cover;"
        >

        <div class="container py-6 position-relative z-index-2">
            <div class="row">
                <div class="col-md-12 mx-auto">

                  
                    <div class="row">
                        @foreach($featured_teams as $team)
                        <div class="col-lg-6 col-12 mb-4  mt-3 d-flex">

                            <div class="card card-profile team-card h-100 w-100">
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
                                    <div class="col-lg-8 col-md-7 col-12">
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
            </div>
        </div>
    </div>
</section>
 
@endisset
@endif

    
        <!-- -------- END Content Presentation Docs ------- -->

        {{-- <section class="py-sm-4" id="download-soft-ui"> --}}
        {{-- <div class="position-relative m-0 border-radius-xl overflow-hidden"> --}}
        {{-- <img src="{{ asset('template/assets/img/shapes/waves-white.svg') }}" alt="pattern-lines"
                    class="position-absolute start-0 top-md-0 w-100 opacity-2"> --}}
        {{-- <iframe class="img-fluid start-0 top-md-0 w-100"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.520745380416!2d90.40099331416613!3d23.764463894157647!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c7a6912ef2e3%3A0xae5c376c60becf51!2sPlug%20Limited!5e0!3m2!1sen!2sbd!4v1644473824527!5m2!1sen!2sbd"
                    width="1140" height="500" style="border:0;" allowfullscreen="" loading="lazy">
                </iframe> --}}
        <div class="container- py-0 postion-relative z-index-2 position-relative">
            <div class="row">
                <div class="col-md-12 mx-auto- text-center">{!! $websiteParameter->google_map_code !!}</div>
            </div>
        </div> 


        <!-- -------   START PRE-FOOTER 2 - simple social line w/ title & 3 buttons    -------- -->
        {{-- <div class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 ms-auto">
                        <h4 class="mb-1">Thank you for your support!</h4>
                        <p class="lead mb-0">We deliver the best web products</p>
                    </div>
                    <div class="col-lg-5 me-lg-auto my-lg-auto text-lg-end mt-5">
                        <a href="https://twitter.com/intent/tweet?text=pluglimited.org" class="btn btn-twitter mb-0 me-2"
                            target="_blank">
                            <i class="fab fa-twitter me-1"></i> Tweet
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.pluglimited.org"
                            class="btn btn-facebook mb-0 me-2" target="_blank">
                            <i class="fab fa-facebook-square me-1"></i> Share
                        </a>
                        <a href="https://www.pinterest.com/pin/create/button/?url=https://pluglimited.org"
                            class="btn btn-pinterest mb-0 me-2" target="_blank">
                            <i class="fab fa-pinterest me-1"></i> Pin it
                        </a>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- -------   END PRE-FOOTER 2 - simple social line w/ title & 3 buttons    -------- -->
    </div>
@endsection

@push('js')
    <script src="https://dotlines.com.sg/vendor/cms-template/dotlines/js/jquery-3.6.0.min.js"></script>
    <script src="https://dotlines.com.sg/vendor/cms-template/dotlines/js/slider.js"></script>
     
{{--     <script>
        $(document).ready(function() {
            $('.owl-carousel').owlCarousel({
                loop: true,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,
                        nav: true
                    },
                    600: {
                        items: 3,
                        nav: false
                    },
                    1000: {
                        items: 5,
                        nav: true,
                        loop: false
                    }
                }
            })
        });
    </script>

    <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    nav: true,
                    loop: true,
                    autoplay: true,


                },
                600: {
                    items: 4,
                    nav: false
                },
                1000: {
                    items: 4,
                    nav: true,
                    loop: true,
                    autoplay: true,
                }
            }
        })
    </script>
 --}}


    <script>
        var TxtType = function(el, toRotate, period) {
            this.toRotate = toRotate;
            this.el = el;
            this.loopNum = 0;
            this.period = parseInt(period, 10) || 2000;
            this.txt = '';
            this.tick();
            this.isDeleting = false;
        };

        TxtType.prototype.tick = function() {
            var i = this.loopNum % this.toRotate.length;
            var fullTxt = this.toRotate[i];

            if (this.isDeleting) {
                this.txt = fullTxt.substring(0, this.txt.length - 1);
            } else {
                this.txt = fullTxt.substring(0, this.txt.length + 1);
            }

            this.el.innerHTML = '<span class="wrap">' + this.txt + '</span>';

            var that = this;
            var delta = 200 - Math.random() * 100;

            if (this.isDeleting) {
                delta /= 2;
            }

            if (!this.isDeleting && this.txt === fullTxt) {
                delta = this.period;
                this.isDeleting = true;
            } else if (this.isDeleting && this.txt === '') {
                this.isDeleting = false;
                this.loopNum++;
                delta = 500;
            }

            setTimeout(function() {
                that.tick();
            }, delta);
        };

        window.onload = function() {
            var elements = document.getElementsByClassName('typewrite');
            for (var i = 0; i < elements.length; i++) {
                var toRotate = elements[i].getAttribute('data-type');
                var period = elements[i].getAttribute('data-period');
                if (toRotate) {
                    new TxtType(elements[i], JSON.parse(toRotate), period);
                }
            }
            // INJECT CSS
            var css = document.createElement("style");
            css.type = "text/css";
            css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #fff}";
            document.body.appendChild(css);
        };


        
document.querySelectorAll('.glass-card').forEach(card => {

card.addEventListener('mousemove', e => {
    const rect = card.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;

    card.style.setProperty('--x', x + 'px');
    card.style.setProperty('--y', y + 'px');
});

});

document.querySelectorAll('.glass-card').forEach(card => {

setInterval(() => {

    const spark = document.createElement('span');
    spark.classList.add('spark');

    spark.style.left = Math.random() * 100 + '%';
    spark.style.bottom = '10px';

    card.appendChild(spark);

    setTimeout(() => {
        spark.remove();
    }, 2000);

}, 600);

});
    </script>
@endpush
