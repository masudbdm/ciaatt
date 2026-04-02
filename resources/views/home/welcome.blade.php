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

            <h1 class="p-2 w3-small mt-2 w3-round" style="background-color: rgba(65, 65, 65, 0.2);">
                <a href="" class="typewrite w3-large text-bolder" data-period="1000" style="color:black;"
                    data-type='[ {{ $websiteParameter->welcome_page_msg }} ]'>
                    <span class="wrap"></span>
                </a>


            </h1>

        </div>

        <section class="pt-3 pb-4" id="count-stats">
            <div class="container">
                <div class="row">
                    {{-- <div class="col-lg-9 mx-auto py-3">
                        <div class="row">
                            <div class="col-md-4 position-relative">
                                <div class="p-3 text-center">
                                    <h1 class="text-gradient text-primary"><span id="state1" countTo="70">0</span>+</h1>
                                    <h5 class="mt-3">Coded Elements</h5>
                                    <p class="text-sm font-weight-normal">From buttons, to inputs, navbars, alerts or
                                        cards, you are covered</p>
                                </div>
                                <hr class="vertical dark">
                            </div>
                            <div class="col-md-4 position-relative">
                                <div class="p-3 text-center">
                                    <h1 class="text-gradient text-primary"> <span id="state2" countTo="15">0</span>+
                                    </h1>
                                    <h5 class="mt-3">Design Blocks</h5>
                                    <p class="text-sm font-weight-normal">Mix the sections, change the colors and
                                        unleash your creativity</p>
                                </div>
                                <hr class="vertical dark">
                            </div>
                            <div class="col-md-4">
                                <div class="p-3 text-center">
                                    <h1 class="text-gradient text-primary" id="state3" countTo="4">0</h1>
                                    <h5 class="mt-3">Pages</h5>
                                    <p class="text-sm font-weight-normal">Save 3-4 weeks of work when you use our
                                        pre-made pages for your website</p>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </section>

        {{-- <section class="my-5 py-5">
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
                                        <h3 class="text-white">Feel the <br /> Material Kit</h3>
                                        <p class="text-white opacity-8">All the Bootstrap components that you need in a
                                            development have been re-design with the new look.</p>
                                    </div>
                                </div>
                                <div class="back back-background"
                                    style="background-image: url(https://images.unsplash.com/photo-1498889444388-e67ea62c464b?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1365&q=80); background-size: cover;">
                                    <div class="card-body pt-7 text-center">
                                        <h3 class="text-white">Discover More</h3>
                                        <p class="text-white opacity-8"> You will save a lot of time going from
                                            prototyping to full-functional code because all elements are implemented.
                                        </p>
                                        <a href=".//sections/page-sections/hero-sections.html" target="_blank"
                                            class="btn btn-white btn-sm w-50 mx-auto mt-3">Start with Headers</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 ms-auto">
                        <div class="row justify-content-start">
                            <div class="col-md-6">
                                <div class="info">
                                    <i class="material-icons text-gradient text-primary text-3xl">content_copy</i>
                                    <h5 class="font-weight-bolder mt-3">Full Documentation</h5>
                                    <p class="pe-5">Built by developers for developers. Check the foundation
                                        and you will find everything inside our documentation.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info">
                                    <i class="material-icons text-gradient text-primary text-3xl">flip_to_front</i>
                                    <h5 class="font-weight-bolder mt-3">Bootstrap 5 Ready</h5>
                                    <p class="pe-3">The world’s most popular front-end open source toolkit,
                                        featuring Sass variables and mixins.</p>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-start mt-5">
                            <div class="col-md-6 mt-3">
                                <i class="material-icons text-gradient text-primary text-3xl">price_change</i>
                                <h5 class="font-weight-bolder mt-3">Save Time & Money</h5>
                                <p class="pe-5">Creating your design from scratch with dedicated designers
                                    can be very expensive. Start with our Design System.</p>
                            </div>
                            <div class="col-md-6 mt-3">
                                <div class="info">
                                    <i class="material-icons text-gradient text-primary text-3xl">devices</i>
                                    <h5 class="font-weight-bolder mt-3">Fully Responsive</h5>
                                    <p class="pe-3">Regardless of the screen size, the website content will
                                        naturally fit the given resolution.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}

        {{-- Start Categories --}}
        {{-- <section class="categories"> --}}
        {{-- <div class="row d-flex justify-content-center"> --}}
        {{-- <div class="row">
                <div class="owl-carousel owl-theme">
                    @foreach ($categoriesPost as $category) --}}
        {{-- <div class="col-md-3 text-center mb-2">
                            <a href="{{ route('user.categoryDetails', $category) }}">
                                <div class="card">
                                    <div class="card-header p-1">
                                        <div class=" d-flex justify-content-center align-items-center"
                                            style="height: 200px;">
                                            <img class="img-fluid"
                                                src="{{ asset('storage/media/image/' . $category->latestPost()->fi()) }}"
                                                alt="img" style="max-height: 100%">
                                        </div>
                                    </div>
                                    <div class="card-body p-1">
                                        <div class="card-title">{!! $category->name !!}</div>
                                    </div>
                                </div>
                            </a>
                        </div> --}}
        {{-- <div>
                            <a href="{{ route('user.categoryDetails', $category) }}">
                                <div class="card elevation-2 mb-2">
                                    <img class="card-img-top"
                                        src="{{ route('imagecache', ['template' => 'cplg', 'filename' => $category->latestPost()->fi()]) }}"
                                        alt="Card image cap">
                                    <div class="card-body p-1">
                                        <h4 class="card-title w3-large m-1 p-1 text-center">{!! $category->name !!}</h4>
                                    
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section> --}}



        <section class="mb-3">
            <div class="row">
                @foreach ($categoriesPost as $category)
                    <div class="col-md-4 col-12">
                        <a href="{{ route('user.categoryDetails', $category) }}" class="text-primary icon-move-right">
                            <div class="card elevation-2 mb-3 mx-2 border-1 border-success-" style="height: 130px">
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
        <section>


            <hr>
            <br>
            <br>

            <section class="presence py-5">
                <div class="container">
                    <h3 class="wow fadeInUp text-center text-second" data-wow-delay=".1s">Our presence</h3>

                    <div class="wow fadeInUp" data-wow-delay=".2s">
                        <div class="presence-map"><img alt="our presence"
                                src="https://dotlines.com.sg/uploads/cms/world-map.svg" />
                            <div class="presence-map-point singapore active">
                                <div class="presence-map-point-overlay">
                                    <div class="points-marker">
                                        <div class="points-marker-effect">&nbsp;</div>
                                    </div>

                                    <div class="points-name">Singapore</div>
                                </div>
                            </div>

                            <div class="presence-map-point malaysia">
                                <div class="presence-map-point-overlay">
                                    <div class="points-marker">
                                        <div class="points-marker-effect">&nbsp;</div>
                                    </div>

                                    <div class="points-name">Malaysia</div>
                                </div>
                            </div>

                            <div class="presence-map-point indonesia">
                                <div class="presence-map-point-overlay">
                                    <div class="points-marker">
                                        <div class="points-marker-effect">&nbsp;</div>
                                    </div>

                                    <div class="points-name">Indonesia</div>
                                </div>
                            </div>

                            <div class="presence-map-point india">
                                <div class="presence-map-point-overlay">
                                    <div class="points-marker">
                                        <div class="points-marker-effect">&nbsp;</div>
                                    </div>

                                    <div class="points-name">India</div>
                                </div>
                            </div>

                            <div class="presence-map-point bangladesh">
                                <div class="presence-map-point-overlay">
                                    <div class="points-marker">
                                        <div class="points-marker-effect">&nbsp;</div>
                                    </div>

                                    <div class="points-name">Bangladesh</div>
                                </div>
                            </div>

                            <div class="presence-map-point myanmar">
                                <div class="presence-map-point-overlay">
                                    <div class="points-marker">
                                        <div class="points-marker-effect">&nbsp;</div>
                                    </div>

                                    <div class="points-name">Myanmar</div>
                                </div>
                            </div>

                            <div class="presence-map-point usa">
                                <div class="presence-map-point-overlay">
                                    <div class="points-marker">
                                        <div class="points-marker-effect">&nbsp;</div>
                                    </div>

                                    <div class="points-name">USA</div>
                                </div>
                            </div>

                            <div class="presence-map-point uae">
                                <div class="presence-map-point-overlay">
                                    <div class="points-marker">
                                        <div class="points-marker-effect">&nbsp;</div>
                                    </div>

                                    <div class="points-name">UAE</div>
                                </div>
                            </div>

                            <div class="presence-map-point panama">
                                <div class="presence-map-point-overlay">
                                    <div class="points-marker">
                                        <div class="points-marker-effect">&nbsp;</div>
                                    </div>

                                    <div class="points-name">Panama</div>
                                </div>
                            </div>

                            <div class="presence-map-point bolivia">
                                <div class="presence-map-point-overlay">
                                    <div class="points-marker">
                                        <div class="points-marker-effect">&nbsp;</div>
                                    </div>

                                    <div class="points-name">Bolivia</div>
                                </div>
                            </div>

                            <div class="presence-map-point nepal">
                                <div class="presence-map-point-overlay">
                                    <div class="points-marker">
                                        <div class="points-marker-effect">&nbsp;</div>
                                    </div>

                                    <div class="points-name">Nepal</div>
                                </div>
                            </div>

                            <div class="presence-map-point srilanka">
                                <div class="presence-map-point-overlay">
                                    <div class="points-marker">
                                        <div class="points-marker-effect">&nbsp;</div>
                                    </div>

                                    <div class="points-name">Sri Lanka</div>
                                </div>
                            </div>

                            <div class="presence-map-point south-africa">
                                <div class="presence-map-point-overlay">
                                    <div class="points-marker">
                                        <div class="points-marker-effect">&nbsp;</div>
                                    </div>

                                    <div class="points-name">South Africa</div>
                                </div>
                            </div>

                            <div class="presence-map-point egypt">
                                <div class="presence-map-point-overlay">
                                    <div class="points-marker">
                                        <div class="points-marker-effect">&nbsp;</div>
                                    </div>

                                    <div class="points-name">Egypt</div>
                                </div>
                            </div>

                            <div class="presence-map-point qatar">
                                <div class="presence-map-point-overlay">
                                    <div class="points-marker">
                                        <div class="points-marker-effect">&nbsp;</div>
                                    </div>

                                    <div class="points-name">Qatar</div>
                                </div>
                            </div>

                            <div class="presence-map-point thailand">
                                <div class="presence-map-point-overlay">
                                    <div class="points-marker">
                                        <div class="points-marker-effect">&nbsp;</div>
                                    </div>

                                    <div class="points-name">Thailand</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </section>
        {{-- country list- --}}
        <section>
            <div class="contanier">
                <div class="row">
                    <div class="col-6 col-md-3">

                        <ul class="list list-icons list-primary">
                            <li class="appear-animation animated fadeInUp appear-animation-visible"
                                data-appear-animation="fadeInUp" data-appear-animation-delay="0"
                                style="animation-delay: 0ms;"><i class="fas fa-check "></i> India</li>

                            <li class="appear-animation animated fadeInUp appear-animation-visible"
                                data-appear-animation="fadeInUp" data-appear-animation-delay="0"
                                style="animation-delay: 0ms;"><i class="fas fa-check "></i> Nepal</li>

                            <li class="appear-animation animated fadeInUp appear-animation-visible"
                                data-appear-animation="fadeInUp" data-appear-animation-delay="0"
                                style="animation-delay: 0ms;"><i class="fas fa-check "></i> China</li>

                            <li class="appear-animation animated fadeInUp appear-animation-visible"
                                data-appear-animation="fadeInUp" data-appear-animation-delay="0"
                                style="animation-delay: 0ms;"><i class="fas fa-check "></i> Vietnam</li>

                            <li class="appear-animation animated fadeInUp appear-animation-visible"
                                data-appear-animation="fadeInUp" data-appear-animation-delay="0"
                                style="animation-delay: 0ms;"><i class="fas fa-check "></i> Singapur</li>
                        </ul>
                    </div>
                    <div class="col-6 col-md-3">

                        <ul class="list list-icons list-primary">
                            <li class="appear-animation animated fadeInUp appear-animation-visible"
                                data-appear-animation="fadeInUp" data-appear-animation-delay="0"
                                style="animation-delay: 0ms;"><i class="fas fa-check "></i> Hong kong</li>

                            <li class="appear-animation animated fadeInUp appear-animation-visible"
                                data-appear-animation="fadeInUp" data-appear-animation-delay="0"
                                style="animation-delay: 0ms;"><i class="fas fa-check "></i> Dubai</li>

                            <li class="appear-animation animated fadeInUp appear-animation-visible"
                                data-appear-animation="fadeInUp" data-appear-animation-delay="0"
                                style="animation-delay: 0ms;"><i class="fas fa-check "></i> Inglaterra</li>

                            <li class="appear-animation animated fadeInUp appear-animation-visible"
                                data-appear-animation="fadeInUp" data-appear-animation-delay="0"
                                style="animation-delay: 0ms;"><i class="fas fa-check "></i> Alemania</li>

                            <li class="appear-animation animated fadeInUp appear-animation-visible"
                                data-appear-animation="fadeInUp" data-appear-animation-delay="0"
                                style="animation-delay: 0ms;"><i class="fas fa-check "></i> Polonia</li>
                        </ul>
                    </div>
                    <div class="col-6 col-md-3">

                        <ul class="list list-icons list-primary">
                            <li class="appear-animation animated fadeInUp appear-animation-visible"
                                data-appear-animation="fadeInUp" data-appear-animation-delay="0"
                                style="animation-delay: 0ms;"><i class="fas fa-check "></i> Republica Checa
                            </li>
                            <li class="appear-animation animated fadeInUp appear-animation-visible"
                                data-appear-animation="fadeInUp" data-appear-animation-delay="0"
                                style="animation-delay: 0ms;"><i class="fas fa-check "></i> Spain </li>
                            <li class="appear-animation animated fadeInUp appear-animation-visible"
                                data-appear-animation="fadeInUp" data-appear-animation-delay="0"
                                style="animation-delay: 0ms;"><i class="fas fa-check "></i> Romania</li>
                            <li class="appear-animation animated fadeInUp appear-animation-visible"
                                data-appear-animation="fadeInUp" data-appear-animation-delay="0"
                                style="animation-delay: 0ms;"><i class="fas fa-check "></i> Bolivia</li>
                            <li class="appear-animation animated fadeInUp appear-animation-visible"
                                data-appear-animation="fadeInUp" data-appear-animation-delay="0"
                                style="animation-delay: 0ms;"><i class="fas fa-check "></i> America ( new
                                York)</li>
                        </ul>
                    </div>
                    <div class="col-6 col-md-3">

                        <ul class="list list-icons list-primary">

                            <li class="appear-animation animated fadeInUp appear-animation-visible"
                                data-appear-animation="fadeInUp" data-appear-animation-delay="0"
                                style="animation-delay: 0ms;"><i class="fas fa-check "></i> Brazil</li>
                            <li class="appear-animation animated fadeInUp appear-animation-visible"
                                data-appear-animation="fadeInUp" data-appear-animation-delay="0"
                                style="animation-delay: 0ms;"><i class="fas fa-check "></i> Peru</li>
                            <li class="appear-animation animated fadeInUp appear-animation-visible"
                                data-appear-animation="fadeInUp" data-appear-animation-delay="0"
                                style="animation-delay: 0ms;"><i class="fas fa-check "></i> Venezuela</li>
                            <li class="appear-animation animated fadeInUp appear-animation-visible"
                                data-appear-animation="fadeInUp" data-appear-animation-delay="0"
                                style="animation-delay: 0ms;"><i class="fas fa-check "></i> Bangladesh</li>


                        </ul>



                    </div>

                </div>

            </div>

        </section>
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
    <script>
        var d_jQuery = Cog.jQuery();



        // add active class in map
        var countries = ['singapore', 'malaysia', 'indonesia', 'india', 'bangladesh', 'myanmar', 'usa', 'uae', 'panama',
            'bolivia', 'nepal', 'srilanka', 'south-africa', 'egypt', 'qatar', 'thailand'
        ];
        var counter = 0;
        setInterval(function() {
            var county_length = d_jQuery('.presence-map-point').length;
            if (county_length == counter) {
                counter = 0;
            }

            d_jQuery('.presence-map-point').removeClass('active');
            d_jQuery('.' + countries[counter]).addClass('active');
            ++counter
        }, 4000);
    </script>
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
    </script>
@endpush
