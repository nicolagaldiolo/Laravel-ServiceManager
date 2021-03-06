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
													<i class="flaticon-edit-1"></i>
												</span>
                        <h3 class="m-portlet__head-text">
                            {{__('messages.edit_customer')}}
                        </h3>
                    </div>
                </div>
            </div>

            <!--begin::Form-->
            <form method="POST" action="{{route('customers.update', $customer)}}" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                @csrf
                @method('PATCH')
                @include('customers._form')
            </form>

            <!--end::Form-->
        </div>

        <!--end::Portlet-->

    </div>
@stop
