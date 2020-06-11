
   <div class="dashboard-sidebar">
        <div class="dashboard-sidebar-inner" data-simplebar>
            <div class="dashboard-nav-container">

                <!-- Responsive Navigation Trigger -->
                <a href="#" class="dashboard-responsive-nav-trigger">
                    <span class="hamburger hamburger--collapse" >
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </span>
                    <span class="trigger-title">Dashboard Navigation</span>
                </a>

                <!-- Navigation -->
                <div class="dashboard-nav">
                    <div class="dashboard-nav-inner">

                        <ul data-submenu-title="Admin Panel">
                            <li class="active"><a href="{{url('/admin/dashboard')}}"><i class="icon-material-outline-dashboard"></i> Dashboard</a></li>
                            <li><a href="#"><i class="icon-material-outline-business-center"></i> Manage Users</a>
                                <ul>
                                    <li><a href="{{url('/admin/all_users')}}">All Users</a></li>
                                    <li><a href="{{url('/admin/all_cases')}}">All Cases</a></li>
                                </ul>
                            </li>
                            <li><a href="#"><i class="icon-material-outline-business-center"></i> Verify Users</a>
                                <ul>
                                    <li><a href="{{url('/admin/verify_request')}}">Verify Request</a></li>
                                    <li><a href="{{url('/admin/verified_account')}}">Verified  Account</a></li>
                                    <li><a href="{{url('/admin/verified_account')}}">Ban Account</a></li>
                                </ul>
                            </li>
                            <li><a href="#"><i class="icon-material-outline-dashboard"></i> View All Messages</a></li>
                            <li><a href="{{route('withdraw.requests')}}"><i class="icon-material-outline-dashboard"></i> Withdraw Requests</a></li>


                            {{-- <li><a href="#"><i class="icon-material-outline-business-center"></i> Funds</a>
                                <ul>
                                    <li><a href="review-funds.html">Review Funds</a></li>
                                </ul>
                            </li> --}}
                             <li><a href="#"><i class="icon-material-outline-dashboard"></i> Escrows</a></li>


                        </ul>


                    </div>
                </div>
                <!-- Navigation / End -->

            </div>
        </div>
    </div>
    <!-- Dashboard Sidebar / End -->