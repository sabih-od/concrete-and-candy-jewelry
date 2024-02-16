@extends('front.layout.app')

@section('content')


    <div class="mouse-cursor cursor-outer"></div>
    <div class="mouse-cursor cursor-inner"></div>

    <section class="innerBan" style="background: url('/images/innerBg.jpg') ">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mainHeading text-center text-white">Checkout</h2>
                </div>
            </div>
        </div>
    </section>

    <div class="check-out-section chkot-pag">
        <div class="container">
            <div class="check-out-form">
                <h2 class="primary-heading">Billing Address</h2>
                <p>
                    Fill the form below to complete your purchase
                </p>
                @if(!Auth::user())
                    <p class="checkout-subheading">
                        <a href="">Already Registered?</a>Click here to <a href="{{route('login.form')}}"
                                                                           class="text-uppercase">Login now</a>
                    </p>
                @endif

                <x-front.checkout.user-form/>
                <hr>
                {{--Order summary section --}}
                <x-front.checkout.order-summary/>
            </div>


        </div>

    </div>

@endsection

@section('script')

    <script>
        $(document).ready(function () {
            // When the checkbox state changes
            $('#shipToOtherAddress').change(function () {
                // If the checkbox is checked, show the address fields; otherwise, hide them
                $('#otherAddressFields').toggle(this.checked);
            });
        });
    </script>
@endsection
