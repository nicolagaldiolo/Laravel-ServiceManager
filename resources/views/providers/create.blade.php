@extends('layouts.app')

@section('content')

    @component('components.title')
        {{__('messages.providers')}}
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
                            {{__('messages.new_provider')}}
                        </h3>
                    </div>
                </div>
            </div>

            <!--begin::Form-->
            <form method="POST" action="{{route('providers.store')}}" class="m-form m-form--fit m-form--label-align-right">
                @csrf
                @include('providers._form')
            </form>

            <!--end::Form-->
        </div>

        <!--end::Portlet-->

    </div>
@stop