<!DOCTYPE html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @php
        /*
        |--------------------------------------------------------------------------
        | Unified SEO Meta Resolver (Page / Post / Category)
        |--------------------------------------------------------------------------
        */

        // Base values
        $siteTitle = $websiteParameter->title;
        $siteDescription = $websiteParameter->meta_description;

        // Title
        $metaTitle =
            $metaTitle
            ?? ($post->title ?? null)
            ?? ($page->page_title ?? null)
            ?? ($category->name ?? null)
            ?? $siteTitle;

        // Description
        $metaDescription =
            $metaDescription
            ?? (isset($post) ? Str::limit(strip_tags($post->excerpt ?? $post->description), 160) : null)
            ?? ($page->meta_description ?? null)
            ?? ($category->description ?? null)
            ?? $siteDescription;

        // Image
        $metaImage =
            $metaImage
            ?? (isset($post) ? asset('storage/media/image/'.$post->fi()) : null)
            ?? (isset($page) ? asset($websiteParameter->logo()) : null)
            ?? (isset($category) ? asset($websiteParameter->logo()) : null)
            ?? asset($websiteParameter->logo());

        // Type
        $metaType = isset($post) ? 'article' : 'website';
    @endphp

    {{-- ===== Primary SEO ===== --}}
    <title>{{ strip_tags($metaTitle) }} | {{ $siteTitle }}</title>
    <meta name="description" content="{{ strip_tags($metaDescription) }}">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- ===== Open Graph ===== --}}
    <meta property="og:type" content="{{ $metaType }}">
    <meta property="og:site_name" content="{{ $siteTitle }}">
    <meta property="og:title" content="{{ strip_tags($metaTitle) }}">
    <meta property="og:description" content="{{ strip_tags($metaDescription) }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ $metaImage }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale" content="en_US">

    {{-- ===== Twitter Card ===== --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ strip_tags($metaTitle) }}">
    <meta name="twitter:description" content="{{ strip_tags($metaDescription) }}">
    <meta name="twitter:image" content="{{ $metaImage }}">

    {{-- ===== Favicon ===== --}}
    <link rel="icon" type="image/png" href="{{ asset($websiteParameter->favIcon()) }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset($websiteParameter->favIcon()) }}">


    @if($websiteParameter->google_analytics_code)

      {!! $websiteParameter->google_analytics_code !!}
      @endif

      @if($websiteParameter->facebook_pixel_code)

      {!! $websiteParameter->facebook_pixel_code !!}
      @endif

      

    {{-- ===== Fonts & Icons ===== --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700">
    <link href="{{ asset('template/assets/css/nucleo-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('template/assets/css/nucleo-svg.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    {{-- Font Awesome (CDN – secure) --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
          crossorigin="anonymous"
          referrerpolicy="no-referrer">

    {{-- ===== Core CSS ===== --}}
    <link id="pagestyle" href="{{ asset('template/assets/css/material-kit.css?v=3.0.0') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    {{-- ===== Theme Dynamic Colors ===== --}}
    <style>
        .text-primary-wp { color: {{ $websiteParameter->primary_color }} !important; }
        .text-secondary-wp { color: {{ $websiteParameter->secondary_color }} !important; }

        .bg-primary-wp {
            background-color: {{ $websiteParameter->primary_color }} !important;
            color: #fff !important;
        }
        .bg-secondary-wp {
            background-color: {{ $websiteParameter->secondary_color }} !important;
            color: #fff !important;
        }

        .wfloating {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 40px;
            right: 40px;
            background-color: #25d366;
            color: #fff;
            border-radius: 50%;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 3px #999;
            z-index: 100;
        }
        .wfloat-button { margin-top: 16px; }
    </style>

    {{-- ===== Page / Post Specific Meta & CSS ===== --}}
    @stack('meta')
    @stack('css')

</head>

<body class="blog-author bg-gray-200">

    @include('home.layouts.pageHeader')
    {{-- @include('home.layouts.pageHeader') --}}
    <div class="content-wrapper">
        @yield('content')
    </div>
    @include('home.layouts.footer')


    <!--   Core JS Files   -->
  <script src="{{asset('template/assets/js/core/popper.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('template/assets/js/core/bootstrap.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('template/assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
  <!--  Plugin for Parallax, full documentation here: https://github.com/wagerfield/parallax  -->
  <script src="{{asset('template/assets/js/plugins/parallax.min.js')}}"></script>
  <!-- Control Center for Material UI Kit: parallax effects, scripts for the example pages etc -->
  <!--  Google Maps Plugin    -->
  {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTTfWur0PDbZWPr7Pmq8K3jiDp0_xUziI"></script> --}}
  <script src="{{asset('template/assets/js/material-kit.min.js?v=3.0.0')}}" type="text/javascript"></script>

{{--   <!-- Go to www.addthis.com/dashboard to customize your tools -->
  <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-61f7d89c55709e9e"></script> --}}
  
  {{-- <a href="https://api.whatsapp.com/send?phone=+8801675834045&text=Hello%21%20." class="wfloating" target="_blank"><i class="fa fa-whatsapp wfloat-button"></i></a> --}}

  <script>
    if (document.getElementsByClassName('page-header')) {
      window.onscroll = debounce(function() {
        var scrollPosition = window.pageYOffset;
        var bgParallax = document.querySelector('.page-header');
        var oVal = (window.scrollY / 3);
        bgParallax.style.transform = 'translate3d(0,' + oVal + 'px,0)';
      }, 6);
    }
  </script>

  @stack('js')
  
</body>

</html>
 