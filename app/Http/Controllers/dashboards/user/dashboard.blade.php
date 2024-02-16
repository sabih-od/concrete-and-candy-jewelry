@extends('dashboards.user.index')

@section('content')


    <div class="col-lg-9 layout">
        <div class="row">
            <div class="col-md-12">
                <div class="userProfile-wrapper">
                    <div class="userProfile-img">
                        <img src="{{$user->userImage()}}" alt="">
                    </div>
                    <div class="userProfile-details">
                        <div class="userName">
                            <h4>{{ ($user->gender == 'Male') ? 'Mr.' :
                    (($user->gender == 'Female') ? 'Mrs.' : '') }}
                                {{$user->name ?? ''}}
                            </h4>
                        </div>
                        <div class="userInfo">
                            <a href="tel:+11234567890"><span><img src="{{ asset('dashboard-assets/images/phone.png') }}"
                                                                  alt="image"
                                                                  class="img-fluid"></span> {{$user->phone ?? ''}}</a>
                            <a href="mailto:info@youremail.com"><span><img
                                        src="{{ asset('dashboard-assets/images/email.png') }}" alt="image"
                                        class="img-fluid"></span>{{$user->email ?? ''}}</a>
                            <a href=""><span><img src="{{ asset('dashboard-assets/images/location.png') }}" alt="image"
                                                  class="img-fluid"></span>
                                {{$user->address ?? ''}}</a>
                        </div>

                        <div class="userCompletion-wrapper">
                            <div class="userOrder-Details">
                                <div class="orderContent">
                                    <h3>{{ isset($orders['ordersCount']) ? str_pad(count($orders['ordersCount']->where('status', 'pending')), 2, '0', STR_PAD_LEFT) : 0 }}</h3>
                                    <h5>Orders Pending!</h5>
                                    <span></span>
                                </div>

                                <div class="orderContent">
                                    <h3>{{ isset($orders['ordersCount']) ? str_pad(count($orders['ordersCount']->where('status', 'completed')), 2, '0', STR_PAD_LEFT) : 0 }}</h3>
                                    <h5>Orders Completed!</h5>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="recentOrders">
            <h4>Recent Orders</h4>
        </div>
        <div class="recentTable tablecard">
            <div class="table-responsive-lg">

                <x-order.dashboard-list-component :orders="$orders['orders']" :pageType="'my_orders'"/>

            </div>
        </div>
    </div>

@endsection
