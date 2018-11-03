@extends('layouts.app')

@section('content')
    @component('components.title', ['back_url' => route('users.index')])
        {{ __('messages.users') }}
    @endcomponent

    <!-- END: Subheader -->
    <div class="m-content">
        <!--begin::Portlet-->
        <div class="m-portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
												<span class="m-portlet__head-icon">
													<i class="flaticon-lock"></i>
												</span>
                                <h3 class="m-portlet__head-text">
                                    {{ __('messages.change_password') }}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form class="m-form m-form--fit" action="{{route('update.password', $user)}}" method="post">
                        @csrf
                        <div class="m-portlet__body">
                            <div class="m-form__section m-form__section--first">
                                <div class="form-group m-form__group">
                                    <label class="">{{__('messages.current_password')}}: *</label>
                                    <div class="m-input-icon m-input-icon--left">
                                        <input type="password" name="current_password" class="form-control m-input" value="{{old('current_password')}}">
                                        <span class="m-input-icon__icon m-input-icon__icon--left">
                                                        <span>
                                                            <i class="la la-unlock"></i>
                                                        </span>
                                                    </span>
                                    </div>
                                    <span class="m-form__help">{{__('messages.enter_password')}}</span>

                                    @if ($errors->has('current_password'))
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('current_password') }}</strong>
                                            </span>
                                    @endif

                                </div>
                                <div class="m-form__seperator m-form__seperator--dashed"></div>

                                <div class="form-group m-form__group">

                                    <label class="">{{__('messages.new_password')}}: *</label>
                                    <div class="m-input-icon m-input-icon--left">
                                        <input type="password" name="new_password" class="form-control m-input" value="{{old('new_password')}}">
                                        <span class="m-input-icon__icon m-input-icon__icon--left">
                                                        <span>
                                                            <i class="la la-unlock-alt"></i>
                                                        </span>
                                                    </span>
                                    </div>
                                    <span class="m-form__help">{{__('messages.enter_new_password')}}</span>

                                    @if ($errors->has('new_password'))
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('new_password') }}</strong>
                                            </span>
                                    @endif

                                </div>

                                <div class="m-form__seperator m-form__seperator--dashed"></div>

                                <div class="form-group m-form__group">

                                    <label class="">{{__('messages.confirm_new_password')}}: *</label>
                                    <div class="m-input-icon m-input-icon--left">
                                        <input type="password" name="new_password_confirmation" class="form-control m-input" value="{{old('new_password_confirmation')}}">
                                        <span class="m-input-icon__icon m-input-icon__icon--left">
                                                        <span>
                                                            <i class="la la-unlock-alt"></i>
                                                        </span>
                                                    </span>
                                    </div>
                                    <span class="m-form__help">{{__('messages.re_enter_new_password')}}</span>

                                    @if ($errors->has('new_password_confirmation'))
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('new_password_confirmation') }}</strong>
                                            </span>
                                    @endif

                                </div>

                            </div>

                        </div>
                        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                            <div class="m-form__actions m-form__actions--solid">
                                <button type="submit" class="btn btn-primary">{{__('messages.save')}}</button>
                                <a href="
                                    @if (Auth::user()->isAdmin())
                                        {{route('users.index')}}
                                    @else
                                        {{route('dashboard')}}
                                    @endif
                                        " class="btn btn-secondary">{{__('messages.cancel')}}</a>
                            </div>
                        </div>
                    </form>

                    <!--end::Form-->
                </div>
    </div>
@stop
