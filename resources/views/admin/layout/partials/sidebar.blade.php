<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                <li class="menu-title">Menu</li>
                <li class="{{ (request()->is('admin/dashboard')) ? 'active-nav' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect">
                        <i class="fas fa-home"></i><span
                            class="badge badge-info badge-pill float-right"></span> <span> Dashboard </span>
                    </a>
                </li>
                {{--                <li class="{{ (request()->is('admin/commission')) ? 'active-nav' : '' }}">--}}
                {{--                    <a href="{{ route('admin.commission') }}" class="waves-effect">--}}
                {{--                        <i class="fas fa-money-bill-alt"></i><span--}}
                {{--                            class="badge badge-info badge-pill float-right"></span> <span>My Commission </span>--}}
                {{--                    </a>--}}
                {{--                </li>--}}
                <li class=" {{(request()->is('admin/user*')) ? '' : 'select-menu' }}">
                    <a href="javascript:void(0);" class="waves-effect selectBtn select-btn"><i
                            class="fas fa-user"></i><span> Users
                            <span class="float-right menu-arrow "><i
                                    class="mdi mdi-chevron-right"></i></span></span></a>
                    <ul class="submenu">
                        <li class="{{ (request()->is('admin/users')) ? 'active-nav' : '' }}"><a
                                href="{{ route('admin.users.index') }}">All Users</a></li>
                        <li class="{{ (request()->is('admin/user/create')) ? 'active-nav' : '' }}"><a
                                href="{{ route('admin.user.create') }}"> Add User</a>
                        </li>
                    </ul>
                </li>


                {{--                <li class=" {{(request()->is('admin/role*')) ? '' : 'select-menu' }}">--}}
                {{--                    <a href="javascript:void(0);" class="waves-effect selectBtn select-btn"><i class="fas fa-users"></i><span> Manage Roles--}}
                {{--                            <span class="float-right menu-arrow select-btn"><i class="mdi mdi-chevron-right"></i></span></span></a>--}}
                {{--                    <ul class="submenu">--}}
                {{--                        <li class="{{ (request()->is('admin/roles')) ? 'active-nav' : '' }}"><a--}}
                {{--                                href="{{ route('admin.roles.index') }}">All Roles</a></li>--}}
                {{--                        <li class="{{ (request()->is('admin/role/create')) ? 'active-nav' : '' }}"><a--}}
                {{--                                href="{{ route('admin.role.create') }}"> Add Role</a>--}}
                {{--                        </li>--}}
                {{--                    </ul>--}}
                {{--                </li>--}}


                <li class=" {{(request()->is('admin/categor*')) ? '' : 'select-menu' }}">
                    <a href="javascript:void(0);" class="waves-effect select-btn"><i class="fas fa-list"></i><span> Categories
                            <span class="float-right menu-arrow "><i
                                    class="mdi mdi-chevron-right"></i></span></span></a>
                    <ul class="submenu">
                        <li class="{{ (request()->is('admin/categories')) ? 'active-nav' : '' }}"><a
                                href="{{ route('admin.category.index') }}">All Categories</a></li>
                        <li class="{{ (request()->is('admin/category/create')) ? 'active-nav' : '' }}"><a
                                href="{{ route('admin.category.create') }}">Add Category</a></li>
                    </ul>
                </li>

                {{--                <li class=" {{(request()->is('admin/size*')) ? '' : 'select-menu' }}">--}}
                {{--                    <a href="javascript:void(0);" class="waves-effect selectBtn select-btn"><i class="fas fa-ruler"></i><span>  Product Sizes--}}
                {{--                            <span class="float-right menu-arrow select-btn"><i class="mdi mdi-chevron-right"></i></span></span></a>--}}
                {{--                    <ul class="submenu">--}}
                {{--                        <li class="{{ (request()->is('admin/sizes')) ? 'active-nav' : '' }}"><a--}}
                {{--                                href="{{ route('admin.sizes.index') }}">All Sizes</a></li>--}}
                {{--                        <li class="{{ (request()->is('admin/size/create')) ? 'active-nav' : '' }}"><a--}}
                {{--                                href="{{ route('admin.size.create') }}"> Add Size</a>--}}
                {{--                        </li>--}}
                {{--                    </ul>--}}
                {{--                </li>--}}


                <li class=" {{(request()->is('admin/product*')) ? '' : 'select-menu' }}">
                    <a href="javascript:void(0);" class="waves-effect select-btn"><i
                            class="fas fa-shopping-cart"></i><span> Products <span
                                class="float-right menu-arrow lol"><i
                                    class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li class="{{ (request()->is('admin/products')) ? 'active-nav' : '' }}"><a
                                href="{{ route('admin.prods.index') }}">All Products</a></li>
                        <li class="{{ (request()->is('admin/product/create')) ? 'active-nav' : '' }}"><a
                                href="{{ route('admin.prod.create') }}">Add Product</a></li>
                    </ul>
                </li>


                <li class=" {{(request()->is('admin/order*')) ? '' : 'select-menu' }}">
                    <a href="javascript:void(0);" class="waves-effect select-btn"><i
                            class="fas fa-shopping-cart"></i><span> Orders <span
                                class="float-right menu-arrow lol"><i
                                    class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li class="{{ (request()->is('admin/orders')) ? 'active-nav' : '' }}"><a
                                href="{{ route('my.orders.index' , ['page' => 'admin']) }}">All Orders</a></li>
                        {{--                        <li class="{{ (request()->is('admin/product/create')) ? 'active-nav' : '' }}"><a--}}
                        {{--                                href="{{ route('admin.prod.create') }}">Add Product</a></li>--}}
                    </ul>
                </li>

                {{--                <li class=" {{(request()->is('admin/wallet*')) ? '' : 'select-menu' }}">--}}
                {{--                    <a href="javascript:void(0);" class="waves-effect select-btn"><i--}}
                {{--                            class="fas fa-shopping-cart"></i><span> Wallet <span--}}
                {{--                                class="float-right menu-arrow lol"><i--}}
                {{--                                    class="mdi mdi-chevron-right"></i></span> </span></a>--}}
                {{--                    <ul class="submenu">--}}
                {{--                        <li class="{{ (request()->is('admin/wallets')) ? 'active-nav' : '' }}"><a--}}
                {{--                                href="{{ route('my.wallets.index') }}">Vendor Wallets</a></li>--}}
                {{--                    </ul>--}}
                {{--                </li>--}}

                {{--                <li class=" {{(request()->is('admin/subscrip*')) ? '' : 'select-menu' }}">--}}
                {{--                    <a href="javascript:void(0);" class="waves-effect select-btn"><i--}}
                {{--                            class="fas fa-file"></i><span> Subscription Plans <span--}}
                {{--                                class="float-right menu-arrow select-btn lol"><i--}}
                {{--                                    class="mdi mdi-chevron-right"></i></span> </span></a>--}}
                {{--                    <ul class="submenu">--}}
                {{--                        <li class="{{ (request()->is('admin/subscriptions')) ? 'active-nav' : '' }}"><a--}}
                {{--                                href="{{ route('admin.subscriptions.index') }}">All Subscription Plans</a></li>--}}
                {{--                        <li class="{{ (request()->is('admin/subscription/create')) ? 'active-nav' : '' }}"><a--}}
                {{--                                href="{{ route('admin.subscription.create') }}">Add Subscription Plan</a></li>--}}
                {{--                    </ul>--}}
                {{--                </li>--}}

                {{--                <li class=" {{(request()->is('admin/voucher*')) ? '' : 'select-menu' }}">--}}
                {{--                    <a href="javascript:void(0);" class="waves-effect select-btn"><i--}}
                {{--                            class="fas fa-file"></i><span> Vouchers <span--}}
                {{--                                class="float-right menu-arrow select-btn lol"><i--}}
                {{--                                    class="mdi mdi-chevron-right"></i></span> </span></a>--}}
                {{--                    <ul class="submenu">--}}
                {{--                        <li class="{{ (request()->is('admin/vouchers')) ? 'active-nav' : '' }}"><a--}}
                {{--                                href="{{ route('admin.voucher.index') }}">All Vouchers</a></li>--}}
                {{--                        <li class="{{ (request()->is('admin/voucher/create')) ? 'active-nav' : '' }}"><a--}}
                {{--                                href="{{ route('admin.voucher.create') }}">Add Voucher</a></li>--}}
                {{--                    </ul>--}}
                {{--                </li>--}}

                <li class=" {{(request()->is('admin/cms*')) ? '' : 'select-menu' }}">
                    <a href="javascript:void(0);" class="waves-effect selectBtn select-btn"><i
                            class="fas fa-list"></i><span> CMS
                            <span class="float-right menu-arrow select-btn "><i
                                    class="mdi mdi-chevron-right"></i></span></span></a>
                    <ul class="submenu">
                        <li class="{{ (request()->is('admin/cms/pages/home/edit')) ? 'active-nav' : '' }}"><a
                                href="{{ route('admin.pages.edit',['slug' => 'home']) }}">Home</a></li>
                        <li class="{{ (request()->is('admin/cms/pages/about/edit')) ? 'active-nav' : '' }}"><a
                                href="{{ route('admin.pages.edit', ['slug' => 'about']) }}">About</a></li>
                        <li class="{{ (request()->is('admin/cms/pages/contact/edit')) ? 'active-nav' : '' }}"><a
                                href="{{ route('admin.pages.edit', ['slug' => 'contact'])  }}">Contact</a></li>
                        <li class="{{ (request()->is('admin/cms/pages/shop/edit')) ? 'active-nav' : '' }}"><a
                                href="{{ route('admin.pages.edit', ['slug' => 'shop'])  }}">Shop</a></li>
                        <li class="{{ (request()->is('admin/cms/pages/cart/edit')) ? 'active-nav' : '' }}"><a
                                href="{{ route('admin.pages.edit', ['slug' => 'faq'])  }}">Faq</a></li>
                        <li class="{{ (request()->is('admin/cms/pages/footer/edit')) ? 'active-nav' : '' }}"><a
                                href="{{ route('admin.pages.edit', ['slug' => 'footer'])  }}">Footer</a></li>
                    </ul>

                </li>


                <li class=" {{(request()->is('admin/setting*')) ? '' : 'select-menu' }}">
                    <a href="javascript:void(0);" class="waves-effect select-btn"><i
                            class="fas fa-cog"></i><span> Settings <span
                                class="float-right menu-arrow lol"><i
                                    class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        {{--                        <li class="{{ (request()->is('admin/settings')) ? 'active-nav' : '' }}"><a--}}
                        {{--                                href="{{ route('admin.settings.edit') }}"> Web Settings</a></li>--}}
                        <li class="{{ (request()->is('admin/settings/edit/1', )) ? 'active-nav' : '' }}"><a
                                href="{{ route('admin.settings.edit',['setting' => 1]) }}">Edit Web Settings</a></li>
                    </ul>
                </li>


            </ul>

        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
