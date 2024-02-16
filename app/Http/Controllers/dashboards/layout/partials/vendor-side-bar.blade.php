<style>
    .custom-active,
    .nav-item.active {
        background-color: #007bff; /* Change to the desired color */
        color: #ffffff; /* Change to the desired text color */
    }
</style>
<section class="dashboard">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3">
                <div class="sideNAvigation">
                    <nav class="navbar navbar-expand-lg p-0">
                        <div class="collapse navbar-collapse" id="">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('vendor.dashboard') }}">
                                        Dashboard
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                       href="{{ route('my.orders.index' , ['page' => 'product_orders']) }}">
                                        Orders
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user.dashboard') }}">
                                        User Dashboard
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link" href="{{ route('vendor.prods.index') }}">
                                        Products
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('vendor.invoices') }}">
                                        Invoices
                                    </a>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link" href="{{ route('vendor.wallet') }}">
                                        Wallet
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link" href="{{ route('subscriptions') }}">
                                        Upgrade Subscription
                                    </a>
                                </li>
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
