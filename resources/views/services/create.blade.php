@extends('layouts.app')

@section('content')

    @component('components.title')
        {{__('messages.domains')}}
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
                            {{__('messages.new_domain')}}
                        </h3>
                    </div>
                </div>
            </div>

            <!--begin::Form-->
            <form method="POST" action="{{route('services.store')}}" class="m-form m-form--fit m-form--label-align-right">
                @csrf
                @include('services._form', ['deadline' => true])
            </form>
            <!--end::Form-->
        </div>
        <!--end::Portlet-->

    </div>
@stop
