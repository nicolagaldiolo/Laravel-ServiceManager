@extends('layouts.app')

@section('content')

    @component('components.title', ['back_url' => route('customers.index')])
        {{__('messages.customers')}}
    @endcomponent
    <div class="m-content">

        <!--Begin::Section-->
        <div class="row">

            <div class="col-xl-6">
                <!--begin:: Widgets/Company Summary-->
                <div class="m-portlet m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon">
                                    <i class="flaticon-browser"></i>
                                </span>
                                <h3 class="m-portlet__head-text">
                                    {{__('messages.customer_info')}}
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">
                                <li class="m-portlet__nav-item">
                                    <a class="btn m-btn--pill btn-secondary" href="{{route('customers.edit', $customer)}}">{{__('messages.edit')}}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-widget13">
                            <div class="m-widget13__item">
				                <span class="m-widget13__desc">{{__('messages.name')}}</span>
                                <span class="m-widget13__text m-widget13__text-bolder">{{$customer->name}}</span>
                            </div>
                            <div class="m-widget13__item">
				                <span class="m-widget13__desc">{{__('messages.email')}}</span>
                                <span class="m-widget13__text m-widget13__text-bolder">{{$customer->email}}</span>
                            </div>
                            <div class="m-widget13__item">
				                <span class="m-widget13__desc">{{__('messages.phone')}}</span>
                                <span class="m-widget13__text">{{$customer->phone}}</span>
                            </div>
                            <div class="m-widget13__item">
				                <span class="m-widget13__desc">{{__('messages.address')}}</span>
                                <span class="m-widget13__text">{{$customer->address}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end:: Widgets/Company Summary-->  </div>

            <div class="col-xl-6">
                <!--begin:: Widgets/Finance Summary-->
                <div class="m-portlet m-portlet--full-height">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon">
                                    <i class="flaticon-diagram"></i>
                                </span>
                                <h3 class="m-portlet__head-text">
                                    {{__('messages.customer_summary')}}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-widget12">
                            <div class="m-widget12__item">
                                <span class="m-widget12__text1">
                                    {{__('messages.total_revenue')}} {{\Carbon\Carbon::now()->year}}<br>
                                    <span>{{amount_format($revenue)}}</span>
                                </span>
                                <div class="m-widget12__text2">
                                    <div class="m-widget12__desc">{{__('messages.avarage_revenue')}}</div>
                                    <br>
                                    <div class="m-widget12__progress">
                                        <div class="m-widget12__progress-sm progress m-progress--sm">
                                            <div class="m-widget12__progress-bar progress-bar bg-brand" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width:{{$revenueAvarage}}%;"></div>
                                        </div>
                                        <span class="m-widget12__stats">{{$revenueAvarage}}%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="m-widget12__item">
                                <span class="m-widget12__text1">{{__('messages.revenues')}}  {{\Carbon\Carbon::now()->format('F Y')}}<br>
                                    <span>{{amount_format($revenueThisMonth)}}</span>
                                </span>
                                <span class="m-widget12__text2">{{__('messages.to_cash_in')}}<br><span>{{$renewalsUnresolved}}</span></span>
                            </div>

                        </div>


                    </div>
                </div>
                <!--end:: Widgets/Finance Summary-->

            </div>

        </div>
        <!--End::Section-->

        @if($customerServicesCount > 0)
            <div class="m-portlet m-portlet--mobile">
                @component('components.tableHeader', [
                    'title' => __('messages.all_services'),
                    'icon' => 'flaticon-layers',
                    'button' => __('messages.new_service'),
                    'url' => route('services.create') . '?cid=' . $customer->id,
                    'newModal' => false,
                    'dataTarget' => '',
                    'moreAction' => true,
                ])
                    @include('customers._dataTableMoreAction')
                @endcomponent

                <div class="m-portlet__body">
                    @include('services._dataTable', ['dataTableDeleteAll' => route('services.destroy-all')])
                </div>
            </div>

        @endif

    </div>
@stop
