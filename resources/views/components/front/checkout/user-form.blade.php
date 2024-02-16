<form action="{{ route('front.payment.form') }}" method="POST">
    @csrf
    <div class="row">


        @if(!Auth::user())
            <div class="col-md-6">
                <label for="">Full name</label>
                <input type="text" name="name"
                       value="{{session()->get('formData') ? session()->get('formData')['name'] : ''}}"
                       class="form-control" {{!Auth::user() ? 'required' : ''}}>
            </div>

            <div class="col-md-6">
                <label for="">email address</label>
                <input type="text" value="{{session()->get('formData') ? session()->get('formData')['email'] : ''}}"
                       name="email" class="form-control"{{!Auth::user() ? 'required' : ''}}>
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="">Phone</label>
                <input type="text" name="phone"
                       value="{{session()->get('formData') ? session()->get('formData')['phone'] : ''}}"
                       class="form-control"{{!Auth::user() ? 'required' : ''}}>
            </div>
            <div class="col-md-6">
                <label for="">password</label>
                <input type="password" name="password"
                       value="{{session()->get('formData') ? session()->get('formData')['password'] : ''}}"
                       class="form-control"{{!Auth::user() ? 'required' : ''}}>
            </div>

            <div class="col-md-12">
                <label for="">Country</label>
                <input type="text" name="country"
                       value="{{session()->get('formData') ? session()->get('formData')['country'] : ''}}"
                       class="form-control"{{!Auth::user() ? 'required' : ''}}>
            </div>
            <div class="col-md-12">
                <label for="">city</label>
                <input type="text" name="city"
                       value="{{session()->get('formData') ? session()->get('formData')['city'] : ''}}"
                       class="form-control"{{!Auth::user() ? 'required' : ''}}>
            </div>
            <div class="col-md-6">
                <label for="">ZIP/POSTAL CODE</label>
                <input type="text" name="zip"
                       value="{{session()->get('formData') ? session()->get('formData')['zip'] : ''}}"
                       class="form-control"{{!Auth::user() ? 'required' : ''}}>
            </div>
            <div class="col-md-6">
                <label for="">sTATE/pROVINCE</label>
                <input type="text" name="state"
                       value="{{session()->get('formData') ? session()->get('formData')['state'] : ''}}"
                       class="form-control"{{!Auth::user() ? 'required' : ''}}>
            </div>

            <input type="hidden" name="role" value="user">

            <div class="col-md-12">
                <label for="">address</label>
                <textarea name="address" id="" cols="30" rows="6"
                          class="form-control">{{session()->get('formData') ? session()->get('formData')['address'] : ''}}</textarea>
            </div>
        @endif

        {{--                        <div class="col-md-12 checkbox">--}}
        {{--                            <input type="checkbox" id="box-1">--}}
        {{--                            <label for="box-1">Craete an account for later use</label>--}}
        {{--                        </div>--}}
        <div class="col-md-12 checkbox">
            <input type="checkbox" id="shipToOtherAddress">
            <label for="shipToOtherAddress">Ship to other address</label>
        </div>

        <div class="col-md-12" id="otherAddressFields" style="display: none;">
            <label for="otherAddress">Shipping Address</label>
            <textarea name="shippingAddress" id="otherAddress" cols="30" rows="6"
                      class="form-control"> {{session()->get('formData') ? session()->get('formData')['shippingAddress'] : ''}}</textarea>
        </div>
    </div>

    <div class="col-md-12 mt-4 p-0">
        {{--        <button type="submit">--}}
        <button class="btn cart-btn w-100">proceed to
            checkout
        </button>
        {{--        </button>--}}
    </div>
</form>
