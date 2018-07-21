@extends('layouts.login')

@section('content')

    <!-- begin:: Page -->
    <div class="m-login__signin">
        <div class="m-login__head">
            <h3 class="m-login__title">{{ __('Sign In To Admin') }}</h3>
        </div>
        <form class="m-login__form m-form formValidate" method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
            @csrf
            <div class="form-group m-form__group">
                <input class="form-control m-input required email{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" placeholder="{{ __('E-Mail Address') }}" name="email" value="{{ old('email') }}" autocomplete="off" autofocus>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group m-form__group">
                <input class="form-control m-input password m-login__form-input--last{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" placeholder="{{ __('Password') }}" name="password">
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="row m-login__form-sub">
                <div class="col m--align-left m-login__form-left">
                    <label class="m-checkbox  m-checkbox--focus">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                        <span></span>
                    </label>
                </div>
                <div class="col m--align-right m-login__form-right">
                    <a href="{{ route('password.request') }}" id="m_login_forget_password" class="m-link">{{ __('Forgot Your Password?') }}</a>
                </div>

            </div>
            <div class="m-login__form-action">
                <button id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">{{ __('Sign in') }}</button>
            </div>
        </form>
    </div>
    <!-- end:: Page -->

@endsection
