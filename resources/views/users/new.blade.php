@extends('layouts.app')

@section('content')

    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">Form Controls</h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="#" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-home"></i>
                        </a>
                    </li>
                    <li class="m-nav__separator">-</li>
                    <li class="m-nav__item">
                        <a href="" class="m-nav__link">
                            <span class="m-nav__link-text">Forms & Controls</span>
                        </a>
                    </li>
                    <li class="m-nav__separator">-</li>
                    <li class="m-nav__item">
                        <a href="" class="m-nav__link">
                            <span class="m-nav__link-text">Form Validation</span>
                        </a>
                    </li>
                    <li class="m-nav__separator">-</li>
                    <li class="m-nav__item">
                        <a href="" class="m-nav__link">
                            <span class="m-nav__link-text">Form Controls</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div>
                <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push"
                     m-dropdown-toggle="hover" aria-expanded="true">
                    <a href="#"
                       class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
                        <i class="la la-plus m--hide"></i>
                        <i class="la la-ellipsis-h"></i>
                    </a>
                    <div class="m-dropdown__wrapper">
                        <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                        <div class="m-dropdown__inner">
                            <div class="m-dropdown__body">
                                <div class="m-dropdown__content">
                                    <ul class="m-nav">
                                        <li class="m-nav__section m-nav__section--first m--hide">
                                            <span class="m-nav__section-text">Quick Actions</span>
                                        </li>
                                        <li class="m-nav__item">
                                            <a href="" class="m-nav__link">
                                                <i class="m-nav__link-icon flaticon-share"></i>
                                                <span class="m-nav__link-text">Activity</span>
                                            </a>
                                        </li>
                                        <li class="m-nav__item">
                                            <a href="" class="m-nav__link">
                                                <i class="m-nav__link-icon flaticon-chat-1"></i>
                                                <span class="m-nav__link-text">Messages</span>
                                            </a>
                                        </li>
                                        <li class="m-nav__item">
                                            <a href="" class="m-nav__link">
                                                <i class="m-nav__link-icon flaticon-info"></i>
                                                <span class="m-nav__link-text">FAQ</span>
                                            </a>
                                        </li>
                                        <li class="m-nav__item">
                                            <a href="" class="m-nav__link">
                                                <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                                <span class="m-nav__link-text">Support</span>
                                            </a>
                                        </li>
                                        <li class="m-nav__separator m-nav__separator--fit">
                                        </li>
                                        <li class="m-nav__item">
                                            <a href="#"
                                               class="btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm">Submit</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- END: Subheader -->
    <div class="m-content">

        <!--begin::Portlet-->
        <div class="m-portlet">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon">
													<i class="la la-gear"></i>
												</span>
                        <h3 class="m-portlet__head-text">
                            Default Form Validation
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