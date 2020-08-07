@extends('layouts.auth')

@section('content')

    <div class="m-login__forget-password">
        <div class="m-login__head">
            <h3 class="m-login__title">{{ __('Forgotten Password ?') }}</h3>
            <div class="m-login__desc">{{ __('Enter your email to reset your password:') }}</div>
        </div>
        <form class="m-login__form m-form" method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
            @csrf
            @honeypot

            <div class="form-group m-form__group">
                <input class="form-control m-input email{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" placeholder="{{ __('E-Mail Address') }}" name="email" id="email" autocomplete="off" value="{{ old('email') }}">

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif

            </div>
            <div class="m-login__form-action">
                <button id="m_login_forget_password_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-login__btn m-login__btn--primaryr">{{ __('Send Password Reset Link') }}</button>&nbsp;&nbsp;
            </div>
        </form>
    </div>

@endsection
