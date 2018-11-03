@extends('layouts.app')

@section('content')

    @component('components.title', ['back_url' => route('services.index')])
        {{__('messages.services')}}
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
                                    <i class="flaticon-responsive"></i>
                                </span>
                                <h3 class="m-portlet__head-text">
                                    {{__('messages.site_screenshoot')}}
                                </h3>
                            </div>
                        </div>
                    </div>

                   <div class="m-form">
                        <div class="m-portlet__body">
                            <div class="m-form__section m-form__section--first">

                                @if(!empty($service->screenshoot))
                                    <img src="{{$service->screenshoot}}" style="max-width: 100%;">
                                @endif

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
												<span class="m-portlet__head-icon">
													<i class="flaticon-edit-1"></i>
												</span>
                                <h3 class="m-portlet__head-text">
                                    {{__('messages.edit_service')}}
                                </h3>
                            </div>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form method="POST" action="{{route('services.update', $service)}}" class="m-form m-form--fit">
                        @csrf
                        @method('PATCH')
                        @include('services._form', ['all_field' => false])
                    </form>

                    <!--end::Form-->
                </div>

                <!--end::Portlet-->
            </div>
        </div>

    </div>
    @include('layouts.partials._modal')
@stop
