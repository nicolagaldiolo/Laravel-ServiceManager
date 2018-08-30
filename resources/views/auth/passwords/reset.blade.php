@extends('layouts.auth')

@section('content')

    <!-- begin:: Page -->
    <div class="m-login__signin">
        <div class="m-login__head">
            <h3 class="m-login__title">{{ __('Reset Password') }}</h3>
        </div>
        <form class="m-login__form m-form" method="POST" action="{{ route('password.request') }}"
              aria-label="{{ __('Reset Password') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group m-form__group">
                <input class="form-control m-input email{{ $errors->has('email') ? ' is-invalid' : '' }}"
                       type="email" placeholder="{{ __('E-Mail Address') }}" name="email"
                       value="{{ $email ?? old('email') }}" autocomplete="off" autofocus>
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

            <div class="m-login__form-action">
                <button id="m_login_signin_submit"
                        class="btn btn-focus m-btn m-btn--pill m-btn--custom m-login__btn m-login__btn--primary">{{ __('Reset Password') }}</button>
            </div>
        </form>
    </div>
    <!-- end:: Page -->
@endsection
