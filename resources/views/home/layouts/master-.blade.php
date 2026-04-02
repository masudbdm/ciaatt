 <!DOCTYPE html>
<html lang="en" itemscope itemtype="https://schema.org/WebPage">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    {{-- Favicon --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset($websiteParameter->favIcon()) }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset($websiteParameter->favIcon()) }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset($websiteParameter->favIcon()) }}">

    {{-- Title --}}
    <title>
        {{ $websiteParameter->title }}
    </title>

    {{-- Meta Description (SEO) --}}
    <meta name="description"
          content="{{ $websiteParameter->meta_description }}">

    {{-- Open Graph Meta --}}
    <meta property="og:type" content="{{ isset($post) ? 'article' : 'website' }}">
    <meta property="og:site_name" content="{{ $websiteParameter->title }}">
    <meta property="og:title"
          content="{{ isset($post) ? strip_tags($post->title) : $websiteParameter->title }}">
    <meta property="og:description"
          content="{{ isset($post)
              ? Str::limit(strip_tags($post->description), 160)
              : $websiteParameter->meta_description }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image"
          content="{{  asset($websiteParameter->logo()) }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale" content="en_US">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title"
          content="{{ isset($post) ? strip_tags($post->title) : $websiteParameter->title }}">
    <meta name="twitter:description"
          content="{{ isset($post)
              ? Str::limit(strip_tags($post->description), 160)
              : $websiteParameter->meta_description }}">
    <meta name="twitter:image"
          content="{{ asset($websiteParameter->logo()) }}">

    {{-- Google Fonts --}}
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700">

    {{-- Core CSS --}}
    <link rel="stylesheet" href="https://dotlines.com.sg/vendor/cms-template/dotlines/css/style.css?v=1">
    <link rel="stylesheet" href="{{ asset('template/assets/css/nucleo-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/nucleo-svg.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/material-kit.css?v=3.0.0') }}">

    {{-- Font Awesome (Correct CDN) --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
          crossorigin="anonymous"
          referrerpolicy="no-referrer">

    {{-- Plugins --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link rel="stylesheet"
          href="https://www.w3schools.com/w3css/4/w3.css">

    {{-- Dynamic Theme Styles --}}
    <style>
        .wfloating{
            position:fixed;
            width:60px;
            height:60px;
            bottom:40px;
            right:40px;
            background-color:#25d366;
            color:#fff;
            border-radius:50%;
            text-align:center;
            font-size:30px;
            box-shadow:2px 2px 3px #999;
            z-index:100;
        }
        .wfloat-button{ margin-top:16px; }

        .text-primary-wp{ color: {{ $websiteParameter->primary_color }} !important; }
        .text-secondary-wp{ color: {{ $websiteParameter->secondary_color }} !important; }

        .bg-primary-wp{
            background-color: {{ $websiteParameter->primary_color }} !important;
            color: #fff !important;
        }
        .bg-secondary-wp{
            background-color: {{ $websiteParameter->secondary_color }} !important;
            color: #fff !important;
        }
    </style>

    @stack('css')
</head>

 <body class="presentation-page bg-gray-200">
     
     
     @include('home.layouts.indexHeader')
     {{-- @include('home.layouts.pageHeader') --}}
     <div class="content-wrapper">
         @yield('content')
     </div>
     @include('home.layouts.footer')
     
 

     <!-- Navbar -->
     {{-- <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <!-- <nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3 navbar-transparent"> -->
        <nav class="navbar navbar-expand-lg  blur border-radius-xl top-0 z-index-fixed shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
          <div class="container-fluid px-0">
            <a class="navbar-brand font-weight-bolder ms-sm-3" href="/" rel="tooltip" title="Plug Limited" data-placement="bottom" target="_blank">
              <img src="assets/fi/favicon.ico" class="rounded-circle m-0 p-0">
              <span class="w3-large w3-text-gray">&nbsp;PLUG LIMITED</span>
            </a>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </span>
            </button>
            <div class="collapse navbar-collapse pt-3 pb-2 py-lg-0 w-100" id="navigation">
              <ul class="navbar-nav navbar-nav-hover ms-auto">
                <li class="nav-item dropdown dropdown-hover mx-2">
                  <a class="nav-link ps-2 d-flex cursor-pointer align-items-center" id="dropdownMenuPages" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="material-icons opacity-6 me-2 text-md text-danger">dashboard</i>
                    Businesses
                    <img src="./assets/img/down-arrow-dark.svg" alt="down-arrow" class="arrow ms-auto ms-md-2">
                  </a>
                  <div class="dropdown-menu dropdown-menu-animation ms-n3 dropdown-md p-3 border-radius-xl mt-0 mt-lg-3" aria-labelledby="dropdownMenuPages">
                    <div class="d-none d-lg-block">
                    <!--   <h6 class="dropdown-header text-dark font-weight-bolder d-flex align-items-center px-1">
                        Landing Pages
                      </h6> -->
                      <a href="" class="dropdown-item border-radius-md text-dark font-weight-bolder">
                        <span>Food Sallo</span>
                      </a>
                      <a href="" class="dropdown-item border-radius-md text-dark font-weight-bolder">
                        <span>Spomax</span>
                      </a>
                      <a href="" class="dropdown-item border-radius-md text-dark font-weight-bolder">
                        <span>Software</span>
                      </a>

                      <a href="" class="dropdown-item border-radius-md text-dark font-weight-bolder">
                        <span>Project Management</span>
                      </a>

                      <a href="" class="dropdown-item border-radius-md text-dark font-weight-bolder">
                        <span>LPG Solution</span>
                      </a>
                      
                    </div>
                    <div class="d-lg-none">
                      <!-- <h6 class="dropdown-header text-dark font-weight-bolder d-flex align-items-center px-1">
                        Landing Pages
                      </h6> -->
                      <a href="" class="dropdown-item border-radius-md text-dark font-weight-bolder">
                        <span>Food Sallo</span>
                      </a>
                      <a href="" class="dropdown-item border-radius-md text-dark font-weight-bolder">
                        <span>Spomax</span>
                      </a>
                      <a href="" class="dropdown-item border-radius-md text-dark font-weight-bolder">
                        <span>Software</span>
                      </a>

                      <a href="" class="dropdown-item border-radius-md text-dark font-weight-bolder">
                        <span>Project Management</span>
                      </a>

                      <a href="" class="dropdown-item border-radius-md text-dark font-weight-bolder">
                        <span>LPG Solution</span>
                      </a>
                       
                    </div>
                  </div>
                </li>


                <li class="nav-item dropdown dropdown-hover mx-2">
                  <a class="nav-link ps-2 d-flex cursor-pointer align-items-center" id="dropdownMenuBlocks" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="material-icons opacity-6 me-2 text-md text-info">view_day</i>
                    About PLUG
                    <img src="./assets/img/down-arrow-dark.svg" alt="down-arrow" class="arrow ms-auto ms-md-2">
                  </a>


           
                  <div class="dropdown-menu dropdown-menu-animation ms-n3 dropdown-md p-3 border-radius-xl mt-0 mt-lg-3" aria-labelledby="dropdownMenuPages">
                    <div class="d-none d-lg-block">
                    <!--   <h6 class="dropdown-header text-dark font-weight-bolder d-flex align-items-center px-1">
                        Landing Pages
                      </h6> -->
                      <a href="" class="dropdown-item border-radius-md text-dark font-weight-bolder">
                        <span>Company Profile</span>
                      </a>
                      <a href="" class="dropdown-item border-radius-md text-dark font-weight-bolder">
                        <span>About Us</span>
                      </a>
                      <a href="" class="dropdown-item border-radius-md text-dark font-weight-bolder">
                        <span>Contact Us</span>
                      </a>

         
 
                      
                    </div>
                    <div class="d-lg-none">
                     <a href="" class="dropdown-item border-radius-md text-dark font-weight-bolder">
                        <span>Company Profile</span>
                      </a>
                      <a href="" class="dropdown-item border-radius-md text-dark font-weight-bolder">
                        <span>About Us</span>
                      </a>
                      <a href="" class="dropdown-item border-radius-md text-dark font-weight-bolder">
                        <span>Contact Us</span>
                      </a>

                       
                    </div>
                  </div>
                </li>
                
              </ul>
            </div>
          </div>
        </nav>
        <!-- End Navbar -->
      </div>
    </div>
  </div>
  <header class="header-2 mb-3">
    <div class="page-header min-vh-75 relative" style="background-image: url('./assets/img/cover2.png')">
      <span class="mask- bg-gradient-primary opacity-4"></span>
      <div class="container">
        <!-- <div class="row">
          <div class="col-lg-7 text-center mx-auto">
            <h1 class="text-white pt-3 mt-n5">Material Kit 2</h1>
            <p class="lead text-white mt-3">Free & Open Source Web UI Kit built over Bootstrap 5. <br /> Join over 1.6 million developers around the world. </p>
          </div>
        </div> -->
      </div>
    </div>
  </header>
  <div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-n6">
    <section class="pt-3 pb-4" id="count-stats">
      <div class="container">
        <div class="row">
          <div class="col-lg-9 mx-auto py-3">
            <div class="row">
              <div class="col-md-4 position-relative">
                <div class="p-3 text-center">
                  <h1 class="text-gradient text-primary"><span id="state1" countTo="70">0</span>+</h1>
                  <h5 class="mt-3">Coded Elements</h5>
                  <p class="text-sm font-weight-normal">From buttons, to inputs, navbars, alerts or cards, you are covered</p>
                </div>
                <hr class="vertical dark">
              </div>
              <div class="col-md-4 position-relative">
                <div class="p-3 text-center">
                  <h1 class="text-gradient text-primary"> <span id="state2" countTo="15">0</span>+</h1>
                  <h5 class="mt-3">Design Blocks</h5>
                  <p class="text-sm font-weight-normal">Mix the sections, change the colors and unleash your creativity</p>
                </div>
                <hr class="vertical dark">
              </div>
              <div class="col-md-4">
                <div class="p-3 text-center">
                  <h1 class="text-gradient text-primary" id="state3" countTo="4">0</h1>
                  <h5 class="mt-3">Pages</h5>
                  <p class="text-sm font-weight-normal">Save 3-4 weeks of work when you use our pre-made pages for your website</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="my-5 py-5">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-4 ms-auto me-auto p-lg-4 mt-lg-0 mt-4">
            <div class="rotating-card-container">
              <div class="card card-rotate card-background card-background-mask-primary shadow-primary mt-md-0 mt-5">
                <div class="front front-background" style="background-image: url(https://images.unsplash.com/photo-1569683795645-b62e50fbf103?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=987&q=80); background-size: cover;">
                  <div class="card-body py-7 text-center">
                    <i class="material-icons text-white text-4xl my-3">touch_app</i>
                    <h3 class="text-white">Feel the <br /> Material Kit</h3>
                    <p class="text-white opacity-8">All the Bootstrap components that you need in a development have been re-design with the new look.</p>
                  </div>
                </div>
                <div class="back back-background" style="background-image: url(https://images.unsplash.com/photo-1498889444388-e67ea62c464b?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1365&q=80); background-size: cover;">
                  <div class="card-body pt-7 text-center">
                    <h3 class="text-white">Discover More</h3>
                    <p class="text-white opacity-8"> You will save a lot of time going from prototyping to full-functional code because all elements are implemented.</p>
                    <a href=".//sections/page-sections/hero-sections.html" target="_blank" class="btn btn-white btn-sm w-50 mx-auto mt-3">Start with Headers</a>
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
                  <p class="pe-5">Built by developers for developers. Check the foundation and you will find everything inside our documentation.</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info">
                  <i class="material-icons text-gradient text-primary text-3xl">flip_to_front</i>
                  <h5 class="font-weight-bolder mt-3">Bootstrap 5 Ready</h5>
                  <p class="pe-3">The world’s most popular front-end open source toolkit, featuring Sass variables and mixins.</p>
                </div>
              </div>
            </div>
            <div class="row justify-content-start mt-5">
              <div class="col-md-6 mt-3">
                <i class="material-icons text-gradient text-primary text-3xl">price_change</i>
                <h5 class="font-weight-bolder mt-3">Save Time & Money</h5>
                <p class="pe-5">Creating your design from scratch with dedicated designers can be very expensive. Start with our Design System.</p>
              </div>
              <div class="col-md-6 mt-3">
                <div class="info">
                  <i class="material-icons text-gradient text-primary text-3xl">devices</i>
                  <h5 class="font-weight-bolder mt-3">Fully Responsive</h5>
                  <p class="pe-3">Regardless of the screen size, the website content will naturally fit the given resolution.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <!-- -------- START Content Presentation Docs ------- -->
    <div class="container mt-sm-5">
      <div class="page-header py-6 py-md-5 my-sm-3 mb-3 border-radius-xl" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/desktop.jpg');" loading="lazy">
        <span class="mask bg-gradient-dark"></span>
        <div class="container">
          <div class="row">
            <div class="col-lg-6 ms-lg-5">
              <h4 class="text-white">Built by developers</h4>
              <h1 class="text-white">Complex Documentation</h1>
              <p class="lead text-white opacity-8">From colors, cards, typography to complex elements, you will find the full documentation. Play with the utility classes and you will create unlimited combinations for our components.</p>
              <a href="https://www.creative-tim.com/learning-lab/bootstrap/overview/material-kit" class="text-white icon-move-right">
                Read docs
                <i class="fas fa-arrow-right text-sm ms-1"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <div class="info-horizontal bg-gradient-primary border-radius-xl d-block d-md-flex p-4">
            <i class="material-icons text-white text-3xl">flag</i>
            <div class="ps-0 ps-md-3 mt-3 mt-md-0">
              <h5 class="text-white">Getting Started</h5>
              <p class="text-white">Check the possible ways of working with our product and the necessary files for building your own project.</p>
              <a href="https://www.creative-tim.com/learning-lab/bootstrap/overview/material-kit" class="text-white icon-move-right">
                Let's start
                <i class="fas fa-arrow-right text-sm ms-1"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 px-lg-1 mt-lg-0 mt-4">
          <div class="info-horizontal bg-gray-100 border-radius-xl d-block d-md-flex p-4 h-100">
            <i class="material-icons text-gradient text-primary text-3xl">precision_manufacturing</i>
            <div class="ps-0 ps-md-3 mt-3 mt-md-0">
              <h5>Plugins</h5>
              <p>Get inspiration and have an overview about the plugins that we used to create the Material Kit.</p>
              <a href="https://www.creative-tim.com/learning-lab/bootstrap/datepicker/material-kit" class="text-primary icon-move-right">
                Read more
                <i class="fas fa-arrow-right text-sm ms-1"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 mt-lg-0 mt-4">
          <div class="info-horizontal bg-gray-100 border-radius-xl d-block d-md-flex p-4">
            <i class="material-icons text-gradient text-primary text-3xl">receipt_long</i>
            <div class="ps-0 ps-md-3 mt-3 mt-md-0">
              <h5>Utility Classes</h5>
              <p>Material Kit is giving you a lot of pre-made elements. For those who want flexibility, we included many utility classes.</p>
              <a href="https://www.creative-tim.com/learning-lab/bootstrap/utilities/material-kit" class="text-primary icon-move-right">
                Read more
                <i class="fas fa-arrow-right text-sm ms-1"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- -------- END Content Presentation Docs ------- -->
    
    <section class="py-sm-7" id="download-soft-ui">
      <div class="bg-gradient-dark position-relative m-3 border-radius-xl overflow-hidden">
        <img src="./assets/img/shapes/waves-white.svg" alt="pattern-lines" class="position-absolute start-0 top-md-0 w-100 opacity-2">
        <div class="container py-7 postion-relative z-index-2 position-relative">
          <div class="row">
            <div class="col-md-7 mx-auto text-center">
              <h3 class="text-white mb-0">P L U G &nbsp; L I M I T E D</h3>
              <!-- <h3 class="text-white">UI Kit for Bootstrap 5?</h3> -->
              <p class="text-white mb-5">Your ultimate business connector</p>
              <a href="" class="btn btn-secondary btn-lg mb-3 mb-sm-0">Contact Now</a>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-6 mx-auto">
            <div class="text-center">
              <h3 class="mt-5 mb-4">Available on these technologies</h3>
              <div class="row justify-content-center">
                <div class="col-lg-2 col-4">
                  <a href="https://www.creative-tim.com/product/soft-ui-design-system" target="_blank">
                    <img src="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/logos/bootstrap5.jpg" class="img-fluid" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Bootstrap 5 - Most popular front-end component library">
                  </a>
                </div>
                <div class="col-lg-2 col-4">
                  <a href="javascript:;">
                    <img src="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/logos/icon-tailwind.jpg" class="img-fluid opacity-6" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Comming soon">
                  </a>
                </div>
                <div class="col-lg-2 col-4">
                  <a href="javascript:;">
                    <img src="https://s3.amazonaws.com/creativetim_bucket/tim_static_images/presentation-page/vue.jpg" class="img-fluid opacity-6" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Comming soon">
                  </a>
                </div>
                <div class="col-lg-2 col-4">
                  <a href="javascript:;">
                    <img src="https://s3.amazonaws.com/creativetim_bucket/tim_static_images/presentation-page/angular.jpg" class="img-fluid opacity-6" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Comming soon">
                  </a>
                </div>
                <div class="col-lg-2 col-4">
                  <a href="javascript:;">
                    <img src="https://s3.amazonaws.com/creativetim_bucket/tim_static_images/presentation-page/react.jpg" class="img-fluid opacity-6" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Comming soon">
                  </a>
                </div>
                <div class="col-lg-2 col-4">
                  <a href="javascript:;" target="_blank">
                    <img src="https://s3.amazonaws.com/creativetim_bucket/tim_static_images/presentation-page/sketch.jpg" class="img-fluid opacity-6" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Comming soon">
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
   
    <!-- -------   START PRE-FOOTER 2 - simple social line w/ title & 3 buttons    -------- -->
    <div class="py-5">
      <div class="container">
        <div class="row">
          <div class="col-lg-5 ms-auto">
            <h4 class="mb-1">Thank you for your support!</h4>
            <p class="lead mb-0">We deliver the best web products</p>
          </div>
          <div class="col-lg-5 me-lg-auto my-lg-auto text-lg-end mt-5">
            <a href="https://twitter.com/intent/tweet?text=pluglimited.org" class="btn btn-twitter mb-0 me-2" target="_blank">
              <i class="fab fa-twitter me-1"></i> Tweet
            </a>
            <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.pluglimited.org" class="btn btn-facebook mb-0 me-2" target="_blank">
              <i class="fab fa-facebook-square me-1"></i> Share
            </a>
            <a href="https://www.pinterest.com/pin/create/button/?url=https://pluglimited.org" class="btn btn-pinterest mb-0 me-2" target="_blank">
              <i class="fab fa-pinterest me-1"></i> Pin it
            </a>
          </div>
        </div>
      </div>
    </div>
    <!-- -------   END PRE-FOOTER 2 - simple social line w/ title & 3 buttons    -------- -->
  </div> --}}

     {{-- jquery --}}
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
          integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer"></script>

     {{-- owlcarousel2 --}}
     {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
          integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}

     <!--   Core JS Files   -->
     <script src="{{ asset('template/assets/js/core/popper.min.js') }}" type="text/javascript"></script>
     <script src="{{ asset('template/assets/js/core/bootstrap.min.js') }}" type="text/javascript"></script>
     <script src="{{ asset('template/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
     <!--  Plugin for TypedJS, full documentation here: https://github.com/inorganik/CountUp.js -->
     {{-- <script src="{{ asset('template/assets/js/plugins/countup.min.js') }}"></script> --}}
     <!--  Plugin for Parallax, full documentation here: https://github.com/dixonandmoe/rellax -->
     <script src="{{ asset('template/assets/js/plugins/rellax.min.js') }}"></script>
     <!--  Plugin for TiltJS, full documentation here: https://gijsroge.github.io/tilt.js/ -->
     <script src="{{ asset('template/assets/js/plugins/tilt.min.js') }}"></script>
     <!--  Plugin for Selectpicker - ChoicesJS, full documentation here: https://github.com/jshjohnson/Choices -->
     <script src="{{ asset('template/assets/js/plugins/choices.min.js') }}"></script>
     <!--  Plugin for Parallax, full documentation here: https://github.com/wagerfield/parallax  -->
     <script src="{{ asset('template/assets/js/plugins/parallax.min.js') }}"></script>
     <!-- Control Center for Material UI Kit: parallax effects, scripts for the example pages etc -->
     <!--  Google Maps Plugin    -->
     {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTTfWur0PDbZWPr7Pmq8K3jiDp0_xUziI"></script> --}}
     <script src="{{ asset('template/assets/js/material-kit.min.js?v=3.0.0') }}" type="text/javascript"></script>
     {{-- <script type="text/javascript">
         if (document.getElementById('state1')) {
             const countUp = new CountUp('state1', document.getElementById("state1").getAttribute("countTo"));
             if (!countUp.error) {
                 countUp.start();
             } else {
                 console.error(countUp.error);
             }
         }
         if (document.getElementById('state2')) {
             const countUp1 = new CountUp('state2', document.getElementById("state2").getAttribute("countTo"));
             if (!countUp1.error) {
                 countUp1.start();
             } else {
                 console.error(countUp1.error);
             }
         }
         if (document.getElementById('state3')) {
             const countUp2 = new CountUp('state3', document.getElementById("state3").getAttribute("countTo"));
             if (!countUp2.error) {
                 countUp2.start();
             } else {
                 console.error(countUp2.error);
             };
         }
     </script> --}}

     @stack('js')
      
    {{-- <a href="https://api.whatsapp.com/send?phone=+8801888066944&text=Hello%21%20." class="wfloating" target="_blank"><i class="fa fa-whatsapp wfloat-button"></i></a> --}}
     
 </body>

 </html>
