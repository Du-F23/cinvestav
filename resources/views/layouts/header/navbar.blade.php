<nav class="navbar p-0 fixed-top d-flex flex-row">
    <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
    </div>
    <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>
        <ul class="navbar-nav w-100"></ul>
        @if(!Auth::check())
            <ul class="navbar-nav w-100">
                <li class="nav-item w-100">
                </li>
                <li class="nav-item dropdown border-left">
                    <a class="nav-link align-items-center d-flex" href="{{route('login')}}" >
                        <i class="mdi mdi-login-variant"></i>
                        <h6 class="p-3 mb-0">Login</h6>
                    </a>
                </li>
                or
                <li class="nav-item dropdown border-left">
                    <a class="nav-link align-items-center d-flex" href="{{route('register')}}">
                        <i class="mdi mdi-account-plus"></i>
                        <h6 class="p-3 mb-0">Register</h6>
                    </a>
                </li>
            </ul>
        @endif
        @if(Auth::check())
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item dropdown">
                    <a class="nav-link" id="profileDropdown" href="#" data-bs-toggle="dropdown">
                        <div class="navbar-profile">
{{--                            <img class="img-xs rounded-circle" src="assets/images/faces/face15.jpg" alt="">--}}
                            <p class="mb-0 d-none d-sm-block navbar-profile-name">{{Auth::user()->name}}</p>
                            <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                        <a class="dropdown-item preview-item" href="{{route('profile.edit')}}">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-dark rounded-circle">
                                    <i class="mdi mdi-account text-google"></i>
                                </div>
                            </div>
                            <div class="preview-item-content">
                                <p class="preview-subject mb-1">Profile</p>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-dark rounded-circle">
                                    <i class="mdi mdi-settings text-success"></i>
                                </div>
                            </div>
                            <div class="preview-item-content">
                                <p class="preview-subject mb-1">Settings</p>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <form class="dropdown-item preview-item" action="{{route('logout')}}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-dark rounded-circle">
                                    <i class="mdi mdi-logout text-danger"></i>
                                </div>
                            </div>
                            <div class="preview-item-content">
                                <button type="submit" class="preview-subject mb-1">Log out</button>
                            </div>
                        </form>
                    </div>
                </li>
            </ul>
        @endif
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item nav-settings d-none d-lg-flex">
                        <i class="mdi mdi-dots-vertical"></i>
                </li>
            </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-format-line-spacing"></span>
        </button>
    </div>
</nav>
