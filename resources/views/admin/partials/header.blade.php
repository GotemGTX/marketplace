<!-- Header Container
================================================== -->
<header id="header-container" class="fullwidth dashboard-header not-sticky"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <!-- Header -->
    <div id="header">
        <div class="container">

            <!-- Left Side Content -->
            <div class="left-side">

                <!-- Logo -->
                <div id="logo">
                    <a href=""><img src="{{asset('backstyling/images/2.png')}}" alt=""></a>
                </div>


                <div class="clearfix"></div>
                <!-- Main Navigation / End -->

            </div>
            <!-- Left Side Content / End -->


            <!-- Right Side Content / End -->
            <div class="right-side">



                <!--  User Notifications / End -->

                <!-- User Menu -->
                <div class="header-widget">

                    <!-- Messages -->
                    <div class="header-notifications user-menu">
                        <div class="header-notifications-trigger">
                            <a href="#">
                                <div class="user-avatar status-online"><img
                                        src="{{asset('backstyling/images/user-avatar-small-01.jpg')}}" alt="">
                                </div>
                            </a>
                        </div>

                        <!-- Dropdown -->
                        <div class="header-notifications-dropdown">

                            <!-- User Status -->
                            <div class="user-status">

                                <!-- User Name / Avatar -->
                                <div class="user-details">
                                    <div class="user-avatar status-online"><img
                                            src="{{asset('backstyling/images/user-avatar-small-01.jpg')}}" alt=""></div>
                                    <div class="user-name">
                                        @guest @else{{auth()->user()->name}}@endif <span>User</span>
                                    </div>
                                </div>

                                <!-- User Status Switcher -->
                                <div class="status-switch" id="snackbar-user-status">
                                    <label class="user-online current-status">Online</label>
                                    <label class="user-invisible">Invisible</label>
                                    <!-- Status Indicator -->
                                    <span class="status-indicator" aria-hidden="true"></span>
                                </div>
                            </div>

                            <ul class="user-menu-small-nav">
                                <li><a href="dashboard.html"><i class="icon-material-outline-dashboard"></i>
                                        Dashboard</a></li>
                                <li><a href="{{url('my/profile')}}"><i class="icon-material-outline-dashboard"></i>
                                        Pprofile</a></li>
                                <li><a href="dashboard-settings.html"><i class="icon-material-outline-settings"></i>
                                        Settings</a></li>
                                <li><a href="{{route('logout')}}"><i
                                            class="icon-material-outline-power-settings-new"></i> Logout</a>
                                </li>
                            </ul>

                        </div>
                    </div>

                </div>
                <!-- User Menu / End -->

                <!-- Mobile Navigation Button -->
                <!--<span class="mmenu-trigger">
                    <button class="hamburger hamburger--collapse" type="button">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </span>-->

            </div>
            <!-- Right Side Content / End -->

        </div>
    </div>
    <!-- Header / End -->

</header>

<div class="clearfix"></div>
<!-- Header Container / End -->