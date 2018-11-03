@extends('layouts.app')

@section('content')

    @component('components.title', ['back_url' => route('customers.index')])
        {{__('messages.customers')}}
    @endcomponent
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
                            {{__('messages.new_customer')}}
                        </h3>
                    </div>
                </div>
            </div>
            @include('customers.create_form')
            <!--end::Form-->
        </div>
        <!--end::Portlet-->
    </div>
@stop
