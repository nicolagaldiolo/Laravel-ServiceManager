@extends('layouts.app')

@section('content')

    @component('components.title')
        Customers
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
                                    Customer info
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-widget13">
                            <div class="m-widget13__item">
				                <span class="m-widget13__desc">Customer Name</span>
                                <span class="m-widget13__text m-widget13__text-bolder">{{$customer->name}}</span>
                            </div>
                            <div class="m-widget13__item">
				                <span class="m-widget13__desc">Email</span>
                                <span class="m-widget13__text m-widget13__text-bolder">{{$customer->email}}</span>
                            </div>
                            <div class="m-widget13__item">
				                <span class="m-widget13__desc">Phone</span>
                                <span class="m-widget13__text">{{$customer->phone}}</span>
                            </div>
                            <div class="m-widget13__item">
				                <span class="m-widget13__desc">Address</span>
                                <span class="m-widget13__text">{{$customer->address}}</span>
                            </div>

                            <div class="m-widget13__action">
                                <a class="btn m-btn--pill btn-secondary" href="{{route('customers.edit', $customer)}}">Edit</a>
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
                                    Customer summary
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-widget12">
                            <div class="m-widget12__item">
                                <span class="m-widget12__text1">Totale fatturato<br><span>€ {{$customerRevenue}}</span></span>
                                <div class="m-widget12__text2">
                                    <div class="m-widget12__desc">Media fatturato totale</div>
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
                                <span class="m-widget12__text1">Servizi attivi<br><span>{{$customerDomainsCount}}</span></span>
                                <span class="m-widget12__text2">Servizi in scadenza<br><span>{{$toPay}}</span></span>
                            </div>

                        </div>


                    </div>
                </div>
                <!--end:: Widgets/Finance Summary-->

            </div>

        </div>
        <!--End::Section-->

    </div>

    @if($customerDomainsCount > 0)
        @include('domains._dataTable', ['dataTableUrl' => route('customers.show', $customer), 'dataTableNewUrl' => route('domains.create') . '?cid=' . $customer->id ])
    @endif
@stop