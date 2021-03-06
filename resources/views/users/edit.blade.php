@extends('layouts.app')

@section('content')
    @component('components.title', ['back_url' => route('users.index')])
        {{__('messages.users')}}
    @endcomponent

    <!-- END: Subheader -->
    <div class="m-content">
        <div class="row">
            <div class="col-lg-4">

                <!--begin::Portlet-->
                <div class="m-portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
												<span class="m-portlet__head-icon">
													<i class="flaticon-profile-1"></i>
												</span>
                                <h3 class="m-portlet__head-text">
                                    {{__('messages.change_avatar')}}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-form">
                        <div class="m-portlet__body">
                            <div class="m-form__section m-form__section--first">
                                <form id="m-dropzone-three" class="m-dropzone dropzone m-dropzone--success" action="{{route('users.avatar.update', $user)}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="custom_avatar" value="1">
                                    <div class="m-dropzone__msg dz-message needsclick">
                                        <h3 class="m-dropzone__msg-title">{{__('messages.drop_zone_avatar')}}</h3>
                                        <span class="m-dropzone__msg-desc">{{__('messages.drop_zone_avatar_desc')}}</span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!--end::Portlet-->


            </div>
            <div class="col-lg-8">

                <!--begin::Portlet-->
                <div class="m-portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
												<span class="m-portlet__head-icon">
													<i class="flaticon-edit-1"></i>
												</span>
                                <h3 class="m-portlet__head-text">
                                    {{__('messages.edit_user')}}
                                </h3>
                            </div>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form class="m-form m-form--fit m-form--label-align-right" action="{{route('users.update', $user)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="m-portlet__body">
                            <div class="m-form__section m-form__section--first">

                                <div class="form-group m-form__group row">
                                    <div class="col-lg-12">
                                        <label class="">{{__('messages.name')}} *</label>
                                        <div class="m-input-icon m-input-icon--left">
                                            <input type="text" name="name" class="form-control m-input required" value="{{old('name', $user->name)}}">
                                            <span class="m-input-icon__icon m-input-icon__icon--left">
                                                            <span>
                                                                <i class="la la-user"></i>
                                                            </span>
                                                        </span>
                                        </div>
                                        <span class="m-form__help">{{__('messages.enter_full_name')}}</span>

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="m-form__seperator m-form__seperator--dashed"></div>

                                <div class="form-group m-form__group row">
                                    <div class="col-lg-12">
                                        <label class="">{{__('messages.email')}} *</label>
                                        <div class="m-input-icon m-input-icon--left">
                                            <input type="email" name="email" class="form-control m-input required email" value="{{old('email', $user->email)}}">
                                            <span class="m-input-icon__icon m-input-icon__icon--left">
                                                            <span>
                                                                <i class="la la-at"></i>
                                                            </span>
                                                        </span>
                                        </div>
                                        <span class="m-form__help">{{__('messages.enter_email')}}</span>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="m-form__seperator m-form__seperator--dashed"></div>

                                <div class="form-group m-form__group row">
                                    <div class="col-lg-12">
                                        <label class="">{{__('messages.language')}}</label>
                                        <div class="m-radio-inline user-lang">
                                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                                <label class="m-radio">
                                                    <input type="radio" name="lang" value="{{$localeCode}}" @if($user->lang == $localeCode) checked @endif>
                                                    <img class="language-img" src="{{ asset('images/flags') .  "/" . $localeCode . ".svg" }}">
                                                    {{ $properties['native'] }}
                                                    <span></span>
                                                </label>
                                            @endforeach
                                        </div>
                                        <span class="m-form__help">{{__('messages.select_language')}}</span>

                                        @if ($errors->has('lang'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('lang') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                @if (Auth::user()->isAdmin())
                                    <div class="m-form__seperator m-form__seperator--dashed"></div>
                                    <div class="form-group m-form__group row">
                                        <div class="col-lg-12">
                                            <label class="">{{__('messages.admin')}}</label>
                                            <div>
                                                <span class="m-switch m-switch--lg m-switch--icon m-switch--success">
                                                    <label>
                                                        <input type="hidden" checked="checked" value="{{\App\Enums\UserType::User}}" name="role">
                                                        <input class="required" type="checkbox" @if(old('role', $user->role) == \App\Enums\UserType::Admin)checked="checked" @endif value="{{\App\Enums\UserType::Admin}}" name="role">
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
                                @endif

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

                <!--end::Portlet-->

                <div class="m-alert m-alert--icon m-alert--outline alert alert-danger no-bg" role="alert">
                    <div class="m-alert__icon">
                        <i class="la la-warning"></i>
                    </div>
                    <div class="m-alert__text">
                        <strong>{{__('messages.delete_account')}}</strong><br>
                        {{__('messages.delete_account_desc')}}
                    </div>
                    <div class="m-alert__actions" style="">
                        <a class="deleteRecord btn btn-danger btn-md m-btn m-btn--pill m-btn--wide" href="{{route('users.destroy', $user)}}">{{__('messages.delete_account')}}</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop

@section('scripts')
    @parent
    <script>



        var DropzoneDemo = function () {

            //== Private functions
            var demos = function () {

                // file type validation
                var drop = Dropzone.options.mDropzoneThree = {
                    paramName: "avatar", // The name that will be used to transfer the file
                    maxFiles: 1,
                    maxFilesize: 10, // MB
                    //addRemoveLinks: true,
                    acceptedFiles: "image/*",
                    accept: function(file, done) {
                        done();
                    }
                };
            }

            return {
                // public functions
                init: function() {
                    demos();
                }
            };
        }();


        DropzoneDemo.init();

    </script>
@stop
