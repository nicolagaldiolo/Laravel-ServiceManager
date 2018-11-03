<div class="m-portlet__body">
    <div class="form-group m-form__group row">
        <div class="col-lg-6">
            <label>{{__('messages.full_name')}} *</label>
            <div class="m-input-icon m-input-icon--left">
                <input type="text" class="form-control m-input" name="name" value="{{old('name', $customer->name)}}">
                <span class="m-input-icon__icon m-input-icon__icon--left"><span><i class="la la-user"></i></span></span>
            </div>
            <span class="m-form__help">{{__('messages.enter_full_name')}}</span>

            <span data-field="name" class="invalid-feedback" role="alert">
                @if ($errors->has('name'))<strong>{{ $errors->first('name') }}</strong>@endif
            </span>

        </div>
        <div class="col-lg-6">
            <label class="">{{__('messages.email')}} *</label>
            <div class="m-input-icon m-input-icon--left">
                <input type="email" class="form-control m-input" name="email" value="{{old('email', $customer->email)}}">
                <span class="m-input-icon__icon m-input-icon__icon--left"><span><i class="la la-envelope"></i></span></span>
            </div>
            <span class="m-form__help">{{__('messages.enter_email')}}</span>

            <span data-field="email" class="invalid-feedback" role="alert">
                @if ($errors->has('email'))<strong>{{ $errors->first('email') }}</strong>@endif
            </span>


        </div>
    </div>
    <div class="form-group m-form__group row">
        <div class="col-lg-6">
            <label>{{__('messages.phone')}}</label>
            <div class="m-input-icon m-input-icon--left">
                <input type="text" class="form-control m-input" name="phone" value="{{old('phone', $customer->phone)}}">
                <span class="m-input-icon__icon m-input-icon__icon--left"><span><i class="la la-phone"></i></span></span>
            </div>
            <span class="m-form__help">{{__('messages.enter_phone')}}</span>
            <span data-field="phone" class="invalid-feedback" role="alert">
                @if ($errors->has('phone'))<strong>{{ $errors->first('phone') }}</strong>@endif
            </span>
        </div>
        <div class="col-lg-6">
            <label class="">{{__('messages.address')}}</label>
            <div class="m-input-icon m-input-icon--left">
                <input type="text" class="form-control m-input" name="address" value="{{old('address', $customer->address)}}">
                <span class="m-input-icon__icon m-input-icon__icon--left"><span><i class="la la-map-marker"></i></span></span>
            </div>
            <span class="m-form__help">{{__('messages.enter_address')}}</span>

            <span data-field="address" class="invalid-feedback" role="alert">
                @if ($errors->has('address'))<strong>{{ $errors->first('address') }}</strong>@endif
            </span>

        </div>
    </div>
</div>
<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
    <div class="m-form__actions m-form__actions--solid">
        <div class="row">
            <div class="col-lg-6">
                <button type="submit" class="btn btn-primary">{{__('messages.save')}}</button>
                <a href="{{route('customers.show', $customer)}}" class="btn btn-secondary cancel">{{__('messages.cancel')}}</a>
            </div>
        </div>
    </div>
</div>
