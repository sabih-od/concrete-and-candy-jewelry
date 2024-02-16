<h1>Store Information</h1><br>

<div class="userProfile-wrapper">
    {{--        <div class="userProfile-img">--}}
    {{--            <img src="{{ asset('dashboard-assets/images/userProfile-img.png') }}" alt="">--}}
    {{--        </div>--}}
    <div class="userProfile-details">
        <div class="userName">
            <h4>{{ $user->vendorShop->name }}</h4>
        </div>
        <div class="userInfo">
            <a href="tel:+11234567890">
                <span></span>Registry Number : {{ $user->vendorShop->register_number }}
            </a>
        </div>


        <div class="userCompletion-wrapper">
            <div class="userContent">
                <p>{{ $user->vendorShop->details }}</p>
            </div>

{{--            <div class="line"></div>--}}
            {{--            <div class="userOrder-Details">--}}
            {{--                <div class="orderContent">--}}
            {{--                    <h3>50</h3>--}}
            {{--                    <h5>Orders Pending!</h5>--}}
            {{--                    <span></span>--}}
            {{--                </div>--}}
            {{--                <div class="orderContent">--}}
            {{--                    <h3>08</h3>--}}
            {{--                    <h5>Orders Processing!!</h5>--}}
            {{--                    <span></span>--}}
            {{--                </div>--}}
            {{--                <div class="orderContent">--}}
            {{--                    <h3>10</h3>--}}
            {{--                    <h5>Orders Completed!</h5>--}}
            {{--                    <span></span>--}}
            {{--                </div>--}}
            {{--            </div>--}}
        </div>


    </div>
</div>
{{--</div>--}}
