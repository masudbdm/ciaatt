<!-- Navbar -->
<div class="container position-sticky z-index-sticky top-0">
    <div class="row">
        <div class="col-12">
            <nav
                class="navbar navbar-expand-lg  blur border-radius-xl top-0 z-index-fixed shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
                <div class="container-fluid px-0">
                    <a class="navbar-brand font-weight-bolder ms-sm-3" href="{{ url('/') }}" rel="tooltip"
                        title="{{ $websiteParameter->h1 }}" data-placement="bottom" target="">
                        <img width="100" src="{{ asset($websiteParameter->logo()) }}" class=" m-0 p-0" ><span class="w3-large w3-text-gray d-none d-md-inline">
    &nbsp;{{ $websiteParameter->h1 }}
</span>

                    </a>
                    <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon mt-2">
                            <span class="navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </span>
                    </button>
                    <div class="collapse navbar-collapse pt-3 pb-2 py-lg-0 w-100" id="navigation">
                        <ul class="navbar-nav navbar-nav-hover ms-auto">
                            {{-- <li class="nav-item dropdown dropdown-hover mx-2">
                                <a class="nav-link ps-2 d-flex cursor-pointer align-items-center" id="dropdownMenuPages"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-home fa-2x"></i>
                                </a>
                            </li> --}}
                            <li class="nav-item dropdown dropdown-hover mx-2">
                                <a class="nav-link ps-2 d-flex cursor-pointer align-items-center" id="dropdownMenuPages"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="material-icons opacity-6 me-2 text-md text-danger">dashboard</i>
                                    Businesses
                                    <img src="{{ asset('template/assets/img/down-arrow-dark.svg') }}" alt="down-arrow"
                                        class="arrow ms-auto ms-md-2">
                                </a>
                                {{-- Desktop --}}
                                <div class="dropdown-menu dropdown-menu-animation ms-n3 dropdown-md p-3 border-radius-xl mt-0 mt-lg-3"
                                    aria-labelledby="dropdownMenuPages">
                                    <div class="d-none d-lg-block">
                                        @foreach ($categoriesForAll as $category)
                                            <a href="{{ route('user.categoryDetails', $category) }}"
                                                class="dropdown-item border-radius-md text-dark font-weight-bolder">
                                                <span>{!! $category->name !!}</span>
                                            </a>
                                        @endforeach
                                    </div>
                                    {{-- Mobile --}}
                                    <div class="d-lg-none">
                                        @foreach ($categories as $category)
                                            <a href="{{ route('user.categoryDetails', $category) }}"
                                                class="dropdown-item border-radius-md text-dark font-weight-bolder">
                                                <span>{!! $category->name !!}</span>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </li>
                            
                            @foreach ($menusForAll as $menu)
                                <li class="nav-item dropdown dropdown-hover mx-2">
                                    <a class="nav-link ps-2 d-flex cursor-pointer align-items-center"
                                        id="dropdownMenuBlocks" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="material-icons opacity-6 me-2 text-md text-info">view_day</i>
                                        {{-- About PLUG --}}
                                        {!! $menu->menu_title !!}
                                        <img src="{{ asset('template/assets/img/down-arrow-dark.svg') }}"
                                            alt="down-arrow" class="arrow ms-auto ms-md-2">
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-animation ms-n3 dropdown-md p-3 border-radius-xl mt-0 mt-lg-3"
                                        aria-labelledby="dropdownMenuPages">
                                        {{-- Destop --}}
                                        <div class="d-none d-lg-block">
                                            @if ($menu->pages)
                                                @foreach ($menu->pages as $page)
                                                    <a href="{{ route('user.pageDetails',['url' => $page->slug , 'page' => $page->id]) }}"
                                                        class="dropdown-item border-radius-md text-dark font-weight-bolder">
                                                        <span>{!! $page->page_title !!}</span>
                                                    </a>
                                                @endforeach
                                                <a href="{{ route('user.contactUs') }}"
                                                    class="dropdown-item border-radius-md text-dark font-weight-bolder">
                                                    <span>Contact Us</span>
                                                </a>

                                                <a href="{{ route('user.teams') }}"
                                        class="dropdown-item border-radius-md text-dark font-weight-bolder">
                                        <span>Our Team</span>
                                    </a>


                                                @auth
 
                                                        <a href="{{ route('admin.dashboard') }}"
                                                           class="dropdown-item border-radius-md text-dark font-weight-bolder">
                                                            <span>Admin Dashboard</span>
                                                        </a>
                                                 
                                                @endauth

                                            @endif
                                        </div>
                                        {{-- Mobile --}}
                                        <div class="d-lg-none">
                                            {{-- <a href=""
                                                class="dropdown-item border-radius-md text-dark font-weight-bolder">
                                                <span>Mobile</span>
                                            </a> --}}
                                            @if ($menu->pages)
                                                @foreach ($menu->pages as $page)
                                                    <a href="{{ route('user.pageDetails',['url' => $page->slug , 'page' => $page->id]) }}"
                                                        class="dropdown-item border-radius-md text-dark font-weight-bolder">
                                                        <span>{!! $page->page_title !!}</span>
                                                    </a>
                                                @endforeach
                                                <a href="{{ route('user.contactUs') }}"
                                                    class="dropdown-item border-radius-md text-dark font-weight-bolder">
                                                    <span>Contact Us</span>
                                                </a>

                                                <a href="{{ route('user.teams') }}"
                                        class="dropdown-item border-radius-md text-dark font-weight-bolder">
                                        <span>Our Team</span>
                                    </a>


                                                @auth
 
                                                <a href="{{ route('admin.dashboard') }}"
                                                   class="dropdown-item border-radius-md text-dark font-weight-bolder">
                                                    <span>Admin Dashboard</span>
                                                </a>
                                         
                                        @endauth


                                            @endif


                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
        </div>
    </div>
</div>
