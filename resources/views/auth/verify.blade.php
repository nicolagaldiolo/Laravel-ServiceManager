@extends('layouts.auth')

@section('content')

    <!-- begin:: Page -->
    <div class="m-login__signin">
        <div class="m-login__head">
            <h3 class="m-login__title">{{ __('Verify Your Email Address') }}</h3>

            <div class="m--margin-top-50 m--margin-bottom-50">
                @if (session('resent'))
                    <div class="m-alert m-alert--icon m-alert--air alert alert-info fade show m--margin-bottom-30" role="alert">
                        <div class="m-alert__icon">
                            <i class="la la-warning"></i>
                        </div>
                        <div class="m-alert__text">
                            <strong>{{ __('A fresh verification link has been sent to your email address.') }}</strong>
                        </div>
                    </div>

                @endif

                <div class="m-login__desc">
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }},
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">
                            {{ __('click here to request another') }}
                        </button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end:: Page -->
@endsection
