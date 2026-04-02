<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{{asset($websiteParameter->logoAlt())}}" alt="{{ $websiteParameter->title }}"
            class="brand-image img-circle- elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ $websiteParameter->short_title }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ route('imagecache', [ 'template'=>'ppmd','filename' => Auth::user()->avatar() ]) }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('admin.dashboard') }}" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        {{-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item {{ session('lsbm') == 'dashboard' ? ' menu-open ' : '' }}">
                    <a href="#" class="nav-link {{ session('lsbm') == 'dashboard' ? ' active ' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ session('lsbsm') == 'adminDashboard' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('admin.websiteParameter') }}"
                                class="nav-link {{ session('lsbsm') == 'websiteParameter' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Website Parameter</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{ session('lsbm') == 'page' ? ' menu-open ' : '' }}">
                    <a href="#" class="nav-link ">
                        <i class="fas fa-compass"></i>
                        <p>
                            {{ __('Menu & Pages') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="{{ route('admin.newMenu') }}"
                                class="nav-link {{ session('lsbsm') == 'newMenu' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('New Menu') }}</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('admin.allMenus') }}"
                                class="nav-link {{ session('lsbsm') == 'allMenus' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('All Menus') }}</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('admin.pagesAll') }}"
                                class="nav-link {{ session('lsbsm') == 'pagesAll' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Pages') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="{{ route('admin.mediaAll') }}"
                        class="nav-link {{ session('lsbm') == 'mediaAll' ? ' active ' : '' }}">
                        <i class="far fa-images"></i>
                        <p>{{ __('Media') }}</p>
                    </a>
                </li>
                <li class="nav-item {{ session('lsbm') == 'role' ? ' menu-open ' : '' }}">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Roles & Permissions
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('roles.index') }}"
                                class="nav-link {{ session('lsbsm') == 'allrole' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Roles</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('roles.create') }}"
                                class="nav-link {{ session('lsbsm') == 'newrole' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>New Role</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('permissions.index') }}"
                                class="nav-link {{ session('lsbsm') == 'allPermission' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Permissions</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('permissions.create') }}"
                                class="nav-link {{ session('lsbsm') == 'newPermission' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>New Permission</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('assignRole') }}"
                                class="nav-link {{ session('lsbsm') == 'assignRole' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Assign Role</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{ session('lsbm') == 'users' ? ' menu-open ' : '' }}">
                    <a href="#" class="nav-link ">
                        <i class="fas fa-users"></i>
                        <p>
                            {{ __('Users') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="{{ route('users.index') }}"
                                class="nav-link {{ session('lsbsm') == 'allUsers' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('All Users') }}</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('users.create') }}"
                                class="nav-link {{ session('lsbsm') == 'addUser' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Add User') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview {{ session('lsbm') == 'category' ? ' menu-open ' : '' }}">
                    <a href="#" class="nav-link ">
                        <i class="fas fa-users"></i>
                        <p>
                            {{ __('Cat & Subcategory') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                       
                        <li class="nav-item ">
                            <a href="{{ route('admin.allCategory') }}"
                                class="nav-link {{ session('lsbsm') == 'allCategory' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('All Categories') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview {{ session('lsbm') == 'post' ? ' menu-open ' : '' }}">
                    <a href="#" class="nav-link ">
                        <i class="fas fa-users"></i>
                        <p>
                            {{ __('Posts') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="{{ route('admin.addNewPost') }}"
                                class="nav-link {{ session('lsbsm') == 'addNewPost' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Add New Post') }}</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('admin.allPost') }}"
                                class="nav-link {{ session('lsbsm') == 'allPost' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Alll Posts') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- <li class="nav-item has-treeview {{ session('lsbm') == 'gallery' ? ' menu-open ' : '' }}">
                    <a href="#" class="nav-link ">
                        <i class="fa fa-image"></i>
                        <p>
                            {{ __('Image Gallery') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="{{ route('admin.addNewImageGallery') }}"
                                class="nav-link {{ session('lsbsm') == 'addNewImageGallery' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Add New Gallery') }}</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('admin.imageGalleriesAll') }}"
                                class="nav-link {{ session('lsbsm') == 'imageGalleriesAll' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('All Galleries') }}</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}

                {{-- <li class="nav-item has-treeview {{ session('lsbm') == 'videoGallery' ? ' menu-open ' : '' }}">
                    <a href="#" class="nav-link ">
                        <i class="fa fa-play"></i>
                        <p>
                            {{ __('Video Gallery') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="{{ route('admin.addVideoGallery') }}"
                                class="nav-link {{ session('lsbsm') == 'addVideoGallery' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Add Video Gallery') }}</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('admin.videoGalleriesAll') }}"
                                class="nav-link {{ session('lsbsm') == 'videoGalleriesAll' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('All Video Galleries') }}</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}

                <li class="nav-item has-treeview {{ session('lsbm') == 'contactUs' ? ' menu-open ' : '' }}">
                    <a href="#" class="nav-link ">
                        <i class="fas fa-address-book"></i>
                        <p>
                            {{ __('Contact Info') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="{{ route('admin.contactUs') }}"
                                class="nav-link {{ session('lsbsm') == 'custommer_message' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Custommer message') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item has-treeview {{ session('lsbm') == 'team' ? ' menu-open ' : '' }}">
    <a href="#" class="nav-link {{ session('lsbm') == 'team' ? ' active ' : '' }}">
        <i class="nav-icon fas fa-users-cog"></i>
        <p>
            Team Members
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>

    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('teams.index') }}"
               class="nav-link {{ session('lsbsm') == 'allTeams' ? ' active ' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>All Members</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('teams.create') }}"
               class="nav-link {{ session('lsbsm') == 'addTeam' ? ' active ' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Member</p>
            </a>
        </li>
    </ul>
</li>



            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
