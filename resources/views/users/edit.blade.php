@extends('layouts.app')

@section('content')
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">Multi Column Forms</h3>
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
                            <span class="m-nav__link-text">Form Layouts</span>
                        </a>
                    </li>
                    <li class="m-nav__separator">-</li>
                    <li class="m-nav__item">
                        <a href="" class="m-nav__link">
                            <span class="m-nav__link-text">Multi Column Forms</span>
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
        <div class="row">
            <div class="col-lg-4">

                <!--begin::Portlet-->
                <div class="m-portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="la la-gear"></i>
												</span>
                                <h3 class="m-portlet__head-text">
                                    User Avatar
                                </h3>
                            </div>
                        </div>
                    </div>

                    <!--begin::Form-->


                    <!--<div class="m-dropzone dropzone m-dropzone--success" id="m-dropzone-three">
                        <div class="m-dropzone__msg dz-message needsclick">
                            <h3 class="m-dropzone__msg-title">Drop files here or click to upload.</h3>
                            <span class="m-dropzone__msg-desc">Only image, pdf and psd files are allowed for upload</span>
                        </div>
                    </div>-->


                    <div class="m-form">
                        <div class="m-portlet__body">
                            <div class="m-form__section m-form__section--first">

                                <form id="m-dropzone-three" class="m-dropzone dropzone m-dropzone--success" action="{{route('users.avatar.update', $user)}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')

                                    <div class="m-dropzone__msg dz-message needsclick">
                                        <h3 class="m-dropzone__msg-title">Drop files here or click to upload.</h3>
                                        <span class="m-dropzone__msg-desc">Only image, pdf and psd files are allowed for upload</span>
                                    </div>
                                </form>


                                <!--<div class="form-group m-form__group">
                                    <div class="m-dropzone dropzone m-dropzone--success" id="m-dropzone-three">
                                        <div class="m-dropzone__msg dz-message needsclick">
                                            <h3 class="m-dropzone__msg-title">Drop files here or click to upload.</h3>
                                            <span class="m-dropzone__msg-desc">Only image, pdf and psd files are allowed for upload</span>
                                        </div>
                                    </div>
                                </div>-->

                            </div>
                        </div>

                    </div>

                    <!--end::Form-->
                </div>

                <!--end::Portlet-->


            </div>
            <div class="col-lg-8">

                <!--begin::Portlet-->
                <div class="m-portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="la la-gear"></i>
												</span>
                                <h3 class="m-portlet__head-text">
                                    Form Sections
                                </h3>
                            </div>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form class="m-form m-form--fit" action="{{route('users.update', $user)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="m-portlet__body">
                            <div class="m-form__section m-form__section--first">
                                <div class="form-group m-form__group">
                                    <label class="">Name:</label>
                                    <div class="m-input-icon m-input-icon--left">
                                        <input type="text" name="name" class="form-control m-input required" placeholder="Enter your name" value="{{old('name', $user->name)}}">
                                        <span class="m-input-icon__icon m-input-icon__icon--left">
                                                        <span>
                                                            <i class="la la-user"></i>
                                                        </span>
                                                    </span>
                                    </div>
                                    <span class="m-form__help">Please enter your name</span>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                    @endif

                                </div>
                                <div class="m-form__seperator m-form__seperator--dashed"></div>

                                <div class="form-group m-form__group">

                                    <label class="">Email: *</label>
                                    <div class="m-input-icon m-input-icon--left">
                                        <input type="email" name="email" class="form-control m-input required email" placeholder="Enter your email" value="{{old('email', $user->email)}}">
                                        <span class="m-input-icon__icon m-input-icon__icon--left">
                                                        <span>
                                                            <i class="la la-at"></i>
                                                        </span>
                                                    </span>
                                    </div>
                                    <span class="m-form__help">Please enter your email</span>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                    @endif

                                </div>

                                @if (Auth::user()->isAdmin())
                                    <div class="m-form__seperator m-form__seperator--dashed"></div>
                                    <div class="form-group m-form__group">
                                        <label class="">Administrator</label>
                                        <div>

                                            <span class="m-switch m-switch--lg m-switch--icon m-switch--success">
                                                <label>
                                                    <input type="hidden" checked="checked" value="user" name="role">
                                                    <input class="required" type="checkbox" @if(old('role', $user->role) == env('USER_ADMIN_ROLE'))checked="checked" @endif value="{{env('USER_ADMIN_ROLE')}}" name="role">
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
                                @endif
                            </div>
                            <!--<div class="m-form__seperator m-form__seperator--dashed"></div>-->
                        </div>
                        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                            <div class="m-form__actions m-form__actions--solid">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button type="reset" class="btn btn-secondary">Cancel</button>
                            </div>
                        </div>
                    </form>

                    <!--end::Form-->
                </div>

                <!--end::Portlet-->
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
                    acceptedFiles: "image/*,application/pdf,.psd",
                    accept: function(file, done) {
                        console.log("Invocata");
                        console.log(file);
                        if (file.name == "justinbieber.jpg") {
                            done("Naha, you don't.");
                        } else {
                            done();
                        }
                    }
                };

                drop.on("addedfile", function(file) {
                    var reader = new FileReader();
                    reader.onload = function(event) {
                        // event.target.result contains base64 encoded image
                        console.log(event.target.result);
                    };
                    reader.readAsDataURL(file);
                });
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
