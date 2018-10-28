@extends('layouts.app')

@section('content')
    @component('components.title', ['back_url' => route('users.index')])
        {{__('messages.users')}}
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
                            {{__('messages.new_user')}}
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
                            <label>{{__('messages.full_name')}} *</label>
                            <div class="m-input-icon m-input-icon--left">
                                <input type="text" class="form-control m-input"
                                       name="name" value="{{old('name')}}">
                                <span class="m-input-icon__icon m-input-icon__icon--left"><span><i
                                                class="la la-user"></i></span></span>
                            </div>
                            <span class="m-form__help">{{__('messages.enter_full_name')}}</span>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif

                        </div>
                        <div class="col-lg-6">
                            <label class="">{{__('messages.email')}} *</label>
                            <div class="m-input-icon m-input-icon--left">
                                <input type="email" class="form-control m-input" name="email"
                                       value="{{old('email')}}">
                                <span class="m-input-icon__icon m-input-icon__icon--left"><span><i
                                                class="la la-envelope"></i></span></span>
                            </div>
                            <span class="m-form__help">{{__('messages.enter_email')}}</span>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif

                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-lg-6">
                            <label>{{__('messages.password')}} *</label>
                            <div class="m-input-icon m-input-icon--left">
                                <input type="password" class="form-control m-input" name="password" value="{{old('password')}}">
                                <span class="m-input-icon__icon m-input-icon__icon--left"><span><i
                                                class="la la-unlock-alt"></i></span></span>
                            </div>
                            <span class="m-form__help">{{__('messages.enter_password')}}</span>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-lg-6">
                            <label class="">{{__('messages.confirm_password')}} *</label>
                            <div class="m-input-icon m-input-icon--left">
                                <input type="password" class="form-control m-input" name="password_confirmation"
                                       value="{{old('password_confirmation')}}">
                                <span class="m-input-icon__icon m-input-icon__icon--left"><span><i
                                                class="la la-unlock-alt"></i></span></span>
                            </div>
                            <span class="m-form__help">{{__('messages.re_enter_password')}}</span>

                            @if ($errors->has('password_confirmation'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <div class="col-lg-6">
                            <label>{{__('messages.admin')}} *</label>
                            <div>
                                <span class="m-switch m-switch--lg m-switch--icon m-switch--success">
                                    <label>
                                        <input type="hidden" checked="checked" value="{{\App\Enums\UserType::User}}" name="role">
                                        <input class="required" type="checkbox" @if(old('role') == \App\Enums\UserType::Admin)checked="checked" @endif value="{{\App\Enums\UserType::Admin}}" name="role">
                                        <span></span>
                                    </label>
                                </span>
                            </div>

                            <span class="m-form__help">{{__('messages.set_admin')}}</span>

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
                                <button type="submit" class="btn btn-primary">{{__('messages.save')}}</button>
                                <a href="{{route('users.index')}}" class="btn btn-secondary">{{__('messages.cancel')}}</a>
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
