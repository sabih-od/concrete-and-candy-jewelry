<div class="order-summery">
    <h2 class="primary-heading text-center">Order Summary</h2>
    <div class="row bb-1">
        <div class="col-md-6">
            <span>Subtotal ({{Cart::count()}} items)</span>
        </div>
        <div class="col-md-6 text-right">
            USD {{Cart::subtotal()}}
        </div>
    </div>

    <div class="row bb-1">
        <div class="col-md-6">
            <span>Shipping fee</span>
        </div>
        <div class="col-md-6 text-right">
            USD 0.00
        </div>
    </div>
{{--    <form action="{{route('front.voucher.add')}}" method="POST">--}}
{{--        @csrf--}}
{{--        <div class="row bb-1">--}}
{{--            <div class="col-md-9">--}}
{{--                <input type="text" name="code" class="form-control" placeholder="Enter Voucher Code">--}}
{{--            </div>--}}
{{--            <div class="col-md-3">--}}
{{--                <button type="submit" class="btn d-btn w-100">Apply</button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </form>--}}

    <div class="row bb-1">
        <div class="col-md-6">
            <span>Total{{session('voucher') ? '(after discount)' : ''}}</span>
        </div>
        <div class="col-md-6 text-right">
            USD {{ session('voucher') ? session('voucher')['total_amount_with_discount'] : Cart::subtotal() }}
        </div>
    </div>

</div>
{{--</form>--}}
