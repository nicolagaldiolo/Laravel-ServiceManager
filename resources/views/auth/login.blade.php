@extends('layouts.auth')

@section('content')

    <!-- begin:: Page -->
    <div class="m-login__signin">
        <div class="m-login__head">
            <h3 class="m-login__title">{{ __('Sign In To Admin') }}</h3>
        </div>
        <form class="m-login__form m-form" method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
            @csrf
            <div class="form-group m-form__group">
                <input class="form-control m-input email{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" placeholder="{{ __('E-Mail Address') }}" name="email" value="{{ old('email') }}" autocomplete="off" autofocus>
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
                <button id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-login__btn m-login__btn--primary">{{ __('Sign in') }}</button>
            </div>
        </form>

        <div class="m-login__form-divider">
            <div class="m-divider">
                <span></span>
                <span>OR</span>
                <span></span>
            </div>
        </div>
        <div class="m-login__options m-social-link">
            <a href="{{route('social.login', 'facebook')}}" class="btn btn-primary m-btn m-btn--pill  m-btn  m-btn m-btn--icon">
									<span>
										<i class="fab fa-facebook-f"></i>
										<span>Facebook</span>
									</span>
            </a>
            <a href="{{route('social.login', 'twitter')}}" class="btn btn-info m-btn m-btn--pill  m-btn  m-btn m-btn--icon">
									<span>
										<i class="fab fa-twitter"></i>
										<span>Twitter</span>
									</span>
            </a>
            <a href="{{route('social.login', 'google')}}" class="btn btn-danger m-btn m-btn--pill  m-btn  m-btn m-btn--icon">
									<span>
										<i class="fab fa-google"></i>
										<span>Google</span>
									</span>
            </a>
            <a href="{{route('social.login', 'github')}}" class="btn btn-secondary m-btn m-btn--pill  m-btn  m-btn m-btn--icon">
									<span>
										<i class="fab fa-github"></i>
										<span>Github</span>
									</span>
            </a>
        </div>

    </div>
    <!-- end:: Page -->

@endsection
