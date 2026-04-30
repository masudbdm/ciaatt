<footer class="footer pt-5 mt-5" style="background: #f0f2f5 !important;">
    <div class="container">
        <div class=" row">
            <div class="col-md-3 mb-4 ms-auto">
                <div>
                    <a href="{{url('/')}}">
                        <img width="180" src="{{ asset($websiteParameter->logo()) }}" class="rounded-circle- m-0 p-0">

                        <!-- <img src="./assets/img/logo-ct-dark.png" class="mb-3 footer-logo" alt="main_logo"> -->
                    </a>
                    <h6 class="font-weight-bolder mb-4">{{ $websiteParameter->h1 }}</h6>
                </div>
                <div class="">
                    <ul class="d-flex flex-row ms-n3 nav">
                        <li class="nav-item">
                            <a class="nav-link pe-1" href="{{ url($websiteParameter->fb_page_link) }}" target="_blank">
                                <i class="fab fa-facebook text-lg opacity-8"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pe-1" href="{{ url($websiteParameter->twitter_url) }}" target="_blank">
                                <i class="fab fa-twitter text-lg opacity-8"></i>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link pe-1" href="{{ url($websiteParameter->youtube_url) }}" target="_blank">
                                <i class="fab fa-youtube text-lg opacity-8"></i>
                            </a>
                        </li>
                        @if (!empty($websiteParameter->linkedin_url))
                        <li class="nav-item">
                            <a class="nav-link pe-1" href="{{ url($websiteParameter->linkedin_url) }}" target="_blank" rel="noopener noreferrer">
                                <i class="fab fa-linkedin text-lg opacity-8"></i>
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-md-2 col-sm-6 col-6 mb-4">
                <div>
                    <h6 class="text-sm">Company</h6>
                    <ul class="flex-column ms-n3 nav">
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.companyProfile') }}" target="_blank">
                                Company Profile
                            </a>
                        </li> --}}
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.aboutUs') }}" target="_blank">
                                About Us
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.contactUs') }}">
                                Contact Us
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="" target="_blank">
                                Blog
                            </a>
                        </li> --}}
                        <hr>
                        <p style="white-space: pre-wrap;">{!! $websiteParameter->footer_address !!}</p>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-6 mb-4">
                <div>
                    <h6 class="text-sm">Resources</h6>
                    <ul class="flex-column ms-n3 nav">
                        @foreach ($categoriesForAll as $category)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.categoryDetails',$category) }}">
                                {!! $category->name !!}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-6 mb-4">
                <div>
                    <h6 class="text-sm">Help & Support</h6>
                    <ul class="flex-column ms-n3 nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.contactUs') }}">
                                Contact Us
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.teams') }}">
                                Our Team
                            </a>
                        </li>

                        @foreach($menusForAll as $mnu)

                        @if ($mnu->pages)
                        @foreach ($mnu->pages as $pg)

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.pageDetails',['url' => $pg->slug , 'page' => $pg->id]) }}">{!! $pg->page_title !!}</a>
                        </li>
                        @endforeach
                        @endif
                        @endforeach

                        <li class="nav-item">
                            <a class="nav-link" href="{{url('webmail')}}">
                                Webmail
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('sitemap') }}">Sitemap (XML)</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('robots') }}">Robots.txt</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('llms') }}">AI discovery (llms.txt)</a>
                        </li>

                    </ul>
                </div>
            </div>
             
            <div class="row d-flex justify-content-center align-items-center">

                <div class="col-md-6  col-12  order-md-2 order-3">
                    <div class="text-center">
                        <p class="text-dark my-4 text-sm font-weight-normal">
                            Copyright © 
                            {{ date('Y') }} <a href="{{url('/')}}" 
                                target="">{{ $websiteParameter->h1 }}</a> All rights reserved. <br>
                                <small>Developed by <a href="{{ url('https://a2sys.co') }}" target="_blank">a2sys.co</a></small>
                        </p>
                    </div>
                </div>
                <div class="col-md-6  col-12 order-md-3 order-2">
                    
                    <div class="text-center">
                        <a href="{{ url($websiteParameter->twitter_url) }}" class="btn btn-twitter mb-2 me-2 btn-sm"
                        target="_blank">
                        <i class="fab fa-twitter me-1"></i> Tweet
                    </a>
                    <a href="{{ url($websiteParameter->fb_page_link) }}"
                        class="btn btn-facebook mb-2 me-2 btn-sm" target="_blank">
                        <i class="fab fa-facebook-square me-1"></i> Share
                    </a>
                    <a href="{{ url($websiteParameter->youtube_url) }}"
                        class="btn btn-youtube mb-2 me-2 btn-sm" target="_blank">
                        <i class="fab fa-youtube me-1"></i> See Video
                    </a>
                    @if (!empty($websiteParameter->linkedin_url))
                    <a href="{{ url($websiteParameter->linkedin_url) }}"
                        class="btn mb-2 me-2 btn-sm" style="background-color:#0A66C2;color:#fff;border-color:#0A66C2;"
                        target="_blank" rel="noopener noreferrer">
                        <i class="fab fa-linkedin me-1"></i> LinkedIn
                    </a>
                    @endif
                    </div>
                    
                    
                </div>
                
            </div>
            
        </div>
    </div>
</footer>