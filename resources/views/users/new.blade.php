@extends('layouts.app')

@section('content')
    @component('components.title')
        Users
    @endcomponent

    <!-- END: Subheader -->
    <div class="m-content">

        <!--begin::Portlet-->
        <div class="m-portlet">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon">
                            <i class="flaticon-plus"></i>
                        </span>
                        <h3 class="m-portlet__head-text">
                            New user
                        </h3>
                    </div>
                </div>
            </div>

            <!--begin::Form-->
            <form method="POST" action="{{route('users.store')}}" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                @csrf
                <div class="m-portlet__body">
                    <div class="form-group m-form__group row">
                        <div class="col-lg-6">
                            <label>Full Name *</label>
                            <div class="m-input-icon m-input-icon--left">
                                <input type="text" class="form-control m-input" placeholder="Enter full name"
                                       name="name" value="{{old('name')}}">
                                <span class="m-input-icon__icon m-input-icon__icon--left"><span><i
                                                class="la la-user"></i></span></span>
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
                                <input type="email" class="form-control m-input" name="email"
                                       placeholder="Enter your email" value="{{old('email')}}">
                                <span class="m-input-icon__icon m-input-icon__icon--left"><span><i
                                                class="la la-envelope"></i></span></span>
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
                            <label>Password *</label>
                            <div class="m-input-icon m-input-icon--left">
                                <input type="password" class="form-control m-input" name="password" value="{{old('password')}}">
                                <span class="m-input-icon__icon m-input-icon__icon--left"><span><i
                                                class="la la-unlock-alt"></i></span></span>
                            </div>
                            <span class="m-form__help">Please enter the password</span>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-lg-6">
                            <label class="">Confirm Password *</label>
                            <div class="m-input-icon m-input-icon--left">
                                <input type="password" class="form-control m-input" name="password_confirmation"
                                       value="{{old('password_confirmation')}}">
                                <span class="m-input-icon__icon m-input-icon__icon--left"><span><i
                                                class="la la-unlock-alt"></i></span></span>
                            </div>
                            <span class="m-form__help">Please re-type the password</span>

                            @if ($errors->has('password_confirmation'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <div class="col-lg-6">
                            <label>Administrator *</label>
                            <div>

                                            <span class="m-switch m-switch--lg m-switch--icon m-switch--success">
                                                <label>
                                                    <input type="hidden" checked="checked"
                                                           value="{{config('userrole.user')}}" name="role">
                                                    <input class="required" type="checkbox"
                                                           @if(old('role') == config('userrole.admin'))checked="checked"
                                                           @endif value="{{config('userrole.admin')}}" name="role">
                                                    <span></span>
                                                </label>
                                            </span>
                            </div>

                            <span class="m-form__help">Please set if this user is administrator.</span>

                            @if ($errors->has('role'))
                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('role') }}</strong>
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
                                <a href="{{route('users.index')}}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!--end::Form-->
        </div>

        <!--end::Portlet-->

    </div>
@stop