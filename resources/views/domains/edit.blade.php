@extends('layouts.app')

@section('content')

    @component('components.title')
        Domains
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
                                    <i class="flaticon-browser"></i>
                                </span>
                                <h3 class="m-portlet__head-text">
                                    Site screenshoot
                                </h3>
                            </div>
                        </div>
                    </div>

                   <div class="m-form">
                        <div class="m-portlet__body">
                            <div class="m-form__section m-form__section--first">

                                @if(!empty($domain->screenshoot))
                                    <img src="{{$domain->screenshoot}}" style="max-width: 100%;">
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
                                    Edit domain
                                </h3>
                            </div>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form method="POST" action="{{route('domains.update', $domain)}}" class="m-form m-form--fit">
                        @csrf
                        @method('PATCH')
                        @include('domains._form', ['deadline' => false])
                    </form>

                    <!--end::Form-->
                </div>

                <!--end::Portlet-->
            </div>
        </div>

    </div>
@stop
