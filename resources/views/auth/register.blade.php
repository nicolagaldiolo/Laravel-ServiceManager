@extends('layouts.auth')

@section('content')

    <div class="m-login__signup">
        <div class="m-login__head">
            <h3 class="m-login__title">{{ __('Sign Up') }}</h3>
            <div class="m-login__desc">{{ __('Enter your details to create your account:') }}</div>
        </div>


        <form class="m-login__form m-form" method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
            @csrf
            <div class="form-group m-form__group">
                <input class="form-control m-input{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" value="{{ old('name') }}" placeholder="{{ __('Fullname') }}" name="name" autofocus>

                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                @endif

            </div>
            <div class="form-group m-form__group">
                <input class="form-control m-input email{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}" name="email" autocomplete="off">

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif

            </div>


            <div class="form-group m-form__group">
                <input
                    class="form-control m-input password m-login__form-input--last{{ $errors->has('password') ? ' is-invalid' : '' }}"
                    type="password" placeholder="{{ __('Password') }}" name="password">
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                @endif
            </div>

            <div class="form-group m-form__group">
                <input class="form-control m-input password password_confirm m-login__form-input--last" type="password" placeholder="{{ __('Confirm Password') }}" name="password_confirmation">
            </div>

            <div class="row form-group m-form__group m-login__form-sub">
                <div class="col m--align-left">
                    <label class="m-checkbox m-checkbox--focus">
                        <input type="checkbox" name="agree">I Agree the <a href="#" class="m-link m-link--focus">terms and conditions</a>.
                        <span></span>
                    </label>
                    <span class="m-form__help"></span>
                </div>
            </div>
            <div class="m-login__form-action">
                <button id="m_login_signup_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-login__btn">{{ __('Register') }}</button>&nbsp;&nbsp;
            </div>
        </form>
    </div>
@endsection
