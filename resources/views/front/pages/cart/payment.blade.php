@extends('front.layout.app')

@section('content')

    {{--THIS CSS FOR LOADER SHOULD BE HERE CAUSE ITS REDIRECT TO PAYPAL FORM OTHERWISE LOADER NOT SHOWING--}}

    <style>
        #loader-container {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
        }

        #loader-text {
            font-size: 24px;
            font-weight: bold;
            color: #F2F2F2;
            display: inline-block;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%)
        }

        .letter {
            display: inline-block;
            animation: bounce 1.5s infinite ease-in-out;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-30px);
            }
            60% {
                transform: translateY(-15px);
            }
        }
    </style>

    <div class="mouse-cursor cursor-outer"></div>
    <div class="mouse-cursor cursor-inner"></div>

    <div id="loader-container">
        <div id="loader-text">
            <span class="letter">P</span>
            <span class="letter">L</span>
            <span class="letter">E</span>
            <span class="letter">A</span>
            <span class="letter">S</span>
            <span class="letter">E</span>
            <span class="letter"> </span>
            <span class="letter">W</span>
            <span class="letter">A</span>
            <span class="letter">I</span>
            <span class="letter">T...</span>
        </div>
    </div>


    <div class="check-out-section">
        <div class="container">
            <div class="check-out-form check-out-3">

                <div class="panel-heading display-table">
                    {{--                    <div class="stripe-logo">--}}
                    {{--                        <img src="https://stripe.com/img/v3/home/twitter.png" alt="Stripe Logo">--}}
                    {{--                    </div>--}}
                    <h3 class="panel-title">Payment Details</h3>
                </div>

                <h2 class="primary-heading">Payment Methods </h2>

                <form
                    role="form"
                    action="{{route('front.stripe.payment')}}"
                    method="post"
                    class="stripe-payment"
                    data-cc-on-file="false"
                    data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                    id="stripe-payment">
                    @csrf
                    <div class="col-12 offset-lg-1 col-lg-10">
                        <div class="row tabs-row fields-row">
                            <div class="col-12 text-center mb-4">
                                <img src="images/card-img.png" alt="">
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>CARD NUMBER</label>
                                    <input autocomplete='off' class='form-control card-number' size='20'
                                           type='text'>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>name on card</label>
                                    <input type="text" class="form-control" placeholder="NAME ON CARD">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>cvv</label>
                                    <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311'
                                           size='4'
                                           type='text'>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Expiration Month</label>
                                    <input class='form-control card-expiry-month' placeholder='MM' size='2'
                                           type='text'>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Expiration Year</label>
                                    <input class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                           type='text'>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class='form-row row'>
                                    <div style="display: none" class='col-md-12 error form-group hide'>
                                        <div class='alert-danger alert'>
                                            {{--    Please correct the errors and try again.--}}
                                        </div>
                                    </div>
                                </div>
                            </div>


                            {{--                            <div class="col-md-6 mt-25">--}}
                            {{--                                <div class="col-md-12 checkbox">--}}
                            {{--                                    <input type="checkbox" id="box-2">--}}
                            {{--                                    <label for="box-2">--}}
                            {{--                                        <h5>save card</h5>--}}
                            {{--                                        information is encrypted and securely stored.--}}
                            {{--                                    </label>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            <div class="col-12 mt-20">
                                <button type="submit" id="order-submit" class="btn cart-btn w-100">Place Order</button>
                            </div>
                        </div>
                    </div>
                    <input name="shippingAddress" hidden
                           value="{{ isset($data['shippingAddress']) ? $data['shippingAddress'] : '' }}">
                </form>

            </div>

        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script src="https://js.stripe.com/v3/"></script>

    <script>
        history.pushState(null, null, location.href);
        window.onpopstate = function () {
            history.go(1);
        };
    </script>
    <script type="text/javascript">

        $(function () {

            /*------------------------------------------
            --------------------------------------------
            Stripe Payment Code
            --------------------------------------------
            --------------------------------------------*/
            var $form = $(this);

            $('.stripe-payment').on('submit', function (e) {
                e.preventDefault();

                $('#loader-container').css('display', 'block');
                // $('#order-submit').prop('disabled', true);

                let cardNumber = $('.card-number').val();
                let cardCVC = $('.card-cvc').val();
                let cardExpMonth = $('.card-expiry-month').val();
                let cardExpYear = $('.card-expiry-year').val();

                var $form = $(this); // Use $(this) to reference the current form
                var $errorMessage = $form.find('div.error');
                $errorMessage.addClass('hide');

                $('.has-error').removeClass('has-error');

                if (cardNumber === '' || cardCVC === '' || cardExpMonth === '' || cardExpYear === '') {
                    // Handle validation errors here, if needed
                    return;
                }

                var $form = $(this),
                    inputSelector = ['input[type=email]', 'input[type=password]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'].join(', '),
                    $inputs = $form.find('.required').find(inputSelector),
                    $errorMessage = $form.find('div.error'),
                    valid = true;
                $errorMessage.addClass('hide');

                $('.has-error').removeClass('has-error');
                $inputs.each(function (i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorMessage.removeClass('hide');
                        e.preventDefault();
                    }
                });

                if (!$form.data('cc-on-file')) {
                    e.preventDefault();

                    let stripePublishableKey = $form.data('stripe-publishable-key');
                    console.log('stripePublishableKey', stripePublishableKey);

                    Stripe.setPublishableKey(stripePublishableKey);
                    Stripe.card.createToken({
                        number: cardNumber,
                        cvc: cardCVC,
                        exp_month: cardExpMonth,
                        exp_year: cardExpYear,
                    }, function (status, response) {
                        console.log('Tokenization response:', response);

                        if (response.error) {
                            // Inform the user if there was an error
                            $('.error')
                                .removeClass('hide')
                                .removeAttr('style')
                                .find('.alert')
                                .text(response.error.message);
                            $('#loader-container').css('display', 'none');

                        } else {

                            // Send the token to your server
                            console.log(response);
                            // document.getElementById('stripeToken').val() = response.id;
                            $form.find('input[type=text]').val(''); // Clear text inputs

                            // Add the token as a hidden input in the form
                            $form.append("<input type='hidden' name='stripe_token' value='" + response.id + "'/>");

                            // Optionally, clear sensitive card data from the form
                            $('.card-number').val('');
                            $('.card-cvc').val('');
                            $('.card-expiry-month').val('');
                            $('.card-expiry-year').val('');

                            $form.get(0).submit();
                        }
                    });
                }
                $('#loader-container').css('display', 'block');

            });
        });
    </script>

@endsection













