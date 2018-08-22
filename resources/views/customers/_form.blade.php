<div class="m-portlet__body">
    <div class="form-group m-form__group row">
        <div class="col-lg-6">
            <label>Full Name *</label>
            <div class="m-input-icon m-input-icon--left">
                <input type="text" class="form-control m-input" placeholder="Enter full name" name="name" value="{{old('name', $customer->name)}}">
                <span class="m-input-icon__icon m-input-icon__icon--left"><span><i class="la la-user"></i></span></span>
            </div>
            <span class="m-form__help">Please enter your full name</span>

            @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
            @endif

        </div>
        <div class="col-lg-6">
            <label class="">Email *</label>
            <div class="m-input-icon m-input-icon--left">
                <input type="email" class="form-control m-input" name="email" placeholder="Enter your email" value="{{old('email', $customer->email)}}">
                <span class="m-input-icon__icon m-input-icon__icon--left"><span><i class="la la-envelope"></i></span></span>
            </div>
            <span class="m-form__help">Please enter your email address</span>

            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
            @endif

        </div>
    </div>
    <div class="form-group m-form__group row">
        <div class="col-lg-6">
            <label>Phone</label>
            <div class="m-input-icon m-input-icon--left">
                <input type="text" class="form-control m-input" placeholder="Enter your phone number" name="phone" value="{{old('phone', $customer->phone)}}">
                <span class="m-input-icon__icon m-input-icon__icon--left"><span><i class="la la-phone"></i></span></span>
            </div>
            <span class="m-form__help">Please enter your phone number</span>

            @if ($errors->has('phone'))
                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
            @endif
        </div>
        <div class="col-lg-6">
            <label class="">Address</label>
            <div class="m-input-icon m-input-icon--left">
                <input type="text" class="form-control m-input" placeholder="Enter your address" name="address" value="{{old('address', $customer->address)}}">
                <span class="m-input-icon__icon m-input-icon__icon--left"><span><i class="la la-map-marker"></i></span></span>
            </div>
            <span class="m-form__help">Please enter your address</span>

            @if ($errors->has('address'))
                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
            @endif
        </div>
    </div>
</div>
<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
    <div class="m-form__actions m-form__actions--solid">
        <div class="row">
            <div class="col-lg-6">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{route('customers.index')}}" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </div>
</div>