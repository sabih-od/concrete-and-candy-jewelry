<section class="dashboard">

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3">
                <div class="sideNAvigation">
                    <nav class="navbar navbar-expand-lg p-0">
                        <div class="collapse navbar-collapse" id="">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link"
                                       href="{{ route('user.dashboard') }}">
                                        Dashboard
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                       href="{{ route('my.orders.index' , ['page' => 'my_orders']) }}">
                                        Total Orders
                                    </a>
                                </li>
                                @if(auth()->user()->hasRole('vendor'))
                                    <li class="nav-item">
                                        <a class="nav-link"
                                           href="{{ route('vendor.dashboard') }}">
                                            Vendor Dashboard
                                        </a>
                                    </li>
                                @endif
                                <li class="nav-item">
                                    <a class="nav-link"
                                       href="{{ route('user.payments.history') }}">
                                        Payments History
                                    </a>
                                </li>

                                @if((auth()->user()->hasRole('user')) && !auth()->user()->hasRole('vendor'))
                                    <li class="nav-item">
                                        <a class="nav-link"
                                           href="{{ route('user.become.vendor') }}">
                                            Become A Vendor
                                        </a>
                                    </li>
                                @endif

                                <li class="nav-item dropdown">
                                    <a class="nav-link"
                                       href="{{ route('user.vendor.profile.edit',auth()->user()->id) }}">
                                        Profile Settings
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="logOut">
                    <a href="{{ route('logout') }}" class="logoutBtn"><img
                            src="{{ asset('dashboard-assets/images/logout.png') }}" alt="">
                        Logout</a>
                </div>
            </div>
