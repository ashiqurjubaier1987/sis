<!-- Menu header start -->
<nav class="navbar header-navbar pcoded-header">
    <div class="navbar-wrapper">

        <div class="navbar-logo">
            <a class="mobile-menu" id="mobile-collapse" href="#!">
                <!-- <i class="feather icon-menu"></i> -->
                <i class="feather ion-chevron-up"></i>
            </a>

            <div class="d-flex justify-content-center w-100">
                <a href="#" class="logo d-inline-flex align-items-center text-decoration-none">
                    <img class="img-fluid" src="{{ asset('storage/' . \App\Support\Settings::get('app_logo')) }}"
                        alt="Student Hub" style="max-height:45px; width:auto;">
                    <p class="mb-0 ml-1 text-light" style="font-weight: 600;">
                        {{ $settings['app_name'] }}
                    </p>
                </a>
            </div>

            <a class="mobile-options">
                <i class="icofont icofont-navigation-menu"></i>
            </a>
        </div>

        <div class="navbar-container container-fluid">
            <ul class="nav-left">
                <li class="header-search">
                    <div class="main-search morphsearch-search">
                        <div class="input-group">
                            <span class="input-group-addon search-close">
                                <i class="feather icon-x"></i>
                            </span>
                            <input type="text" class="form-control">
                            <span class="input-group-addon search-btn">
                                <i class="feather icon-search"></i>
                            </span>
                        </div>
                    </div>
                </li>
                <li>
                    <a href="#!" onclick="javascript:toggleFullScreen()">
                        <i class="feather icon-maximize full-screen"></i>
                    </a>
                </li>
            </ul>

            <ul class="nav-right">
                {{-- Notifications --}}
                <li class="header-notification">
                    <div class="dropdown-primary dropdown">
                        <div class="dropdown-toggle" data-toggle="dropdown">
                            <i class="feather icon-bell"></i>
                            <span class="badge bg-c-pink">5</span>
                        </div>

                        <ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn"
                            data-dropdown-out="fadeOut">
                            <li>
                                <h6>Notifications</h6>
                                <label class="label label-danger">New</label>
                            </li>

                            <li>
                                <div class="media">
                                    <img class="d-flex align-self-center img-radius"
                                        src="{{ asset('adminend/images/avatar-4.jpg') }}" alt="User">
                                    <div class="media-body">
                                        <h5 class="notification-user">John Doe</h5>
                                        <p class="notification-msg">
                                            Lorem ipsum dolor sit amet, consectetuer elit.
                                        </p>
                                        <span class="notification-time">30 minutes ago</span>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="media">
                                    <img class="d-flex align-self-center img-radius"
                                        src="{{ asset('adminend/images/avatar-3.jpg') }}" alt="User">
                                    <div class="media-body">
                                        <h5 class="notification-user">Joseph William</h5>
                                        <p class="notification-msg">
                                            Lorem ipsum dolor sit amet, consectetuer elit.
                                        </p>
                                        <span class="notification-time">30 minutes ago</span>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="media">
                                    <img class="d-flex align-self-center img-radius"
                                        src="{{ asset('adminend/images/avatar-4.jpg') }}" alt="User">
                                    <div class="media-body">
                                        <h5 class="notification-user">Sara Soudein</h5>
                                        <p class="notification-msg">
                                            Lorem ipsum dolor sit amet, consectetuer elit.
                                        </p>
                                        <span class="notification-time">30 minutes ago</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- Messages --}}
                <li class="header-notification">
                    <div class="dropdown-primary dropdown">
                        <div class="displayChatbox dropdown-toggle" data-toggle="dropdown">
                            <i class="feather icon-message-square"></i>
                            <span class="badge bg-c-green">3</span>
                        </div>
                    </div>
                </li>

                {{-- User Profile --}}
                <li class="user-profile header-notification">
                    <div class="dropdown-primary dropdown">
                        <div class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ asset('adminend/images/avatar-4.jpg') }}" class="img-radius"
                                alt="User-Profile-Image">
                            <span>{{Auth::user()->name}}</span>
                            <i class="feather icon-chevron-down"></i>
                        </div>

                        <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn"
                            data-dropdown-out="fadeOut">

                            <li>
                                <a href="#!">
                                    <i class="feather icon-settings"></i> Settings
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="feather icon-user"></i> Profile
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="feather icon-mail"></i> My Messages
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="feather icon-lock"></i> Lock Screen
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}">
                                    <i class="feather icon-log-out"></i> Logout
                                </a>
                            </li>
                        </ul>

                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- Menu header end -->
