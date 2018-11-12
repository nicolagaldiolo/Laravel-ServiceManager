@extends('layouts.app')

@section('content')

    <!-- END: Subheader -->
    <div class="m-content">
        <div class="m-portlet">
            <div class="m-portlet__body m-portlet__body--no-padding">
                <div class="row m-row--no-padding m-row--col-separator-xl">
                    <div class="col-md-12 col-lg-12 col-xl-3">
                        <!--begin:: Widgets/Stats2-1 -->
                        <div class="m-widget1">
                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <h3 class="m-widget1__title">{{__('messages.total_revenue')}} {{\Carbon\Carbon::now()->year}}</h3>
                                        <span class="m-widget1__desc">{{__(trans_choice('messages.obtained_from', $dashboard['servicesThisYearCount'], [ 'attribute' => $dashboard['servicesThisYearCount']]))}}</span>
                                        <br>
                                        <span class="m-widget1__number m--font-brand">
                                            {{amount_format($dashboard['servicesThisYearSum'])}}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end:: Widgets/Stats2-1 -->
                    </div>
                    <div class="col-md-12 col-lg-12 col-xl-3">
                        <!--begin:: Widgets/Stats2-1 -->
                        <div class="m-widget1">
                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <h3 class="m-widget1__title">{{__('messages.revenues')}}  {{\Jenssegers\Date\Date::now()->format('F Y')}}</h3>
                                        <span class="m-widget1__desc">{{__(trans_choice('messages.obtained_from', $dashboard['servicesThisMonthCount'], [ 'attribute' => $dashboard['servicesThisMonthCount']]))}}</span>
                                        <br>
                                        <span class="m-widget1__number m--font-info">
                                            {{amount_format($dashboard['servicesThisMonthSum'])}}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end:: Widgets/Stats2-1 -->
                    </div>
                    <div class="col-md-12 col-lg-12 col-xl-3">
                        <!--begin:: Widgets/Stats2-1 -->
                        <div class="m-widget1">
                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <h3 class="m-widget1__title">{{__('messages.to_cash_in')}}</h3>
                                        <span class="m-widget1__desc">{{__(trans_choice('messages.obtained_from', $servicesToPayCount, [ 'attribute' => $servicesToPayCount]))}}</span>
                                        <br>
                                        <span class="m-widget1__number m--font-danger">{{amount_format($feesToPayAmount)}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end:: Widgets/Stats2-1 -->
                    </div>
                    <div class="col-md-12 col-lg-12 col-xl-3">
                        <!--begin:: Widgets/Stats2-1 -->
                        <div class="m-widget1">
                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <h3 class="m-widget1__title">{{__('messages.sales_impact')}}</h3>
                                        <span class="m-widget1__desc">{{__('messages.monthly_sales_amount')}}</span>
                                        <br>
                                        <span class="m-widget1__number m--font-success">{{$dashboard['monthlyService_percent']}}
                                            %</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end:: Widgets/Stats2-1 -->
                    </div>

                </div>
            </div>
        </div>


        <!--Begin::Section-->
        <div class="row">
            <div class="col-xl-6">

                <!--begin:: Widgets/Top Products-->
                <div class="m-portlet m-portlet--bordered-semi m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon">
                                    <i class="flaticon-line-graph"></i>
                                </span>
                                <h3 class="m-portlet__head-text">
                                    {{__('messages.trend')}} {{\Carbon\Carbon::now()->year}}
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">
                                <li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push"
                                    m-dropdown-toggle="hover" aria-expanded="true">
                                    <a href="{{route('services.index')}}"
                                       class="m-portlet__nav-link btn btn--sm m-btn--pill btn-brand m-btn">
                                        {{__('messages.all_services')}}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__body">

                        <!--begin::Widget5-->
                        <div class="m-widget4">
                            <div class="m-widget4__chart m-portlet-fit--sides m--margin-top-10 m--margin-top-20"
                                 style="height:260px;">
                                <canvas id="m_chart_activities"></canvas>
                            </div>

                            <!--begin::Widget 11-->
                            <div class="m-widget11 m--margin-top-20">
                                <div class="m-portlet__head m--padding-0">
                                    <div class="m-portlet__head-caption">
                                        <div class="m-portlet__head-title">
                                            <span class="m-portlet__head-icon">
                                                <i class="flaticon-piggy-bank"></i>
                                            </span>
                                            <h3 class="m-portlet__head-text">
                                                {{__('messages.to_cash_in')}}
                                            </h3>
                                        </div>
                                    </div>
                                </div>

                                @if($servicesToPay->isEmpty())
                                    <div class="alert alert-brand" role="alert">
                                        <strong>{{__('messages.fantastic')}}</strong> {{__('messages.no_other_services')}}
                                    </div>
                                @else
                                    <div class="m-widget11__service_list">
                                        @foreach($servicesToPay as $service)
                                            <div class="m-widget11__info_content">

                                                <img src="{{$service->screenshoot}}" alt="">
                                                <div class="m-widget11__item_info">
                                                    <div class="m-widget11__item_info_top">
                                                        <div>
                                                            <span class="m-widget11__title">{{$service->name}}</span>
                                                            <span class="m-widget11__sub">{{$service->customer->name}}</span>
                                                        </div>
                                                        <a href="{{route('services.show', $service)}}"  class="btn m-btn--pill btn-outline-brand m-btn btn-sm">{{__('messages.edit')}}</a>
                                                    </div>
                                                    <div class="m-widget6">
                                                        <div class="m-widget6__body">
                                                            @foreach($service->renewalsUnresolved as $renewal)
                                                                <div class="m-widget6__item">
                                                                    <span class="m-widget6__text">
                                                                        <span class="m--font-boldest">{{$renewal->deadline->diffForHumans()}}</span> ({{$renewal->deadlineVerbose}})
                                                                    </span>
                                                                    <span class="m-widget6__text m--align-right m--font-boldest m--font-brand">
                                                                        {{amount_format($renewal->amount)}}
                                                                    </span>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <!--end::Widget 11-->
                        </div>
                        <!--end::Widget 5-->
                    </div>
                </div>
                <!--end:: Widgets/Top Products-->
            </div>

            <div class="col-xl-6">

                <!--begin:: Widgets/Activity-->
                <div
                    class="m-portlet m-portlet--bordered-semi m-portlet--widget-fit m-portlet--full-height m-portlet--skin-light  m-portlet--rounded-force">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon">
                                    <i class="flaticon-stopwatch m--font-light"></i>
                                </span>
                                <h3 class="m-portlet__head-text m--font-light">
                                    {{__('messages.summary')}}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-widget17">
                            <div
                                class="m-widget17__visual m-widget17__visual--chart m-portlet-fit--top m-portlet-fit--sides m--bg-danger">
                                <div class="m-widget17__chart" style="height:320px;"></div>
                            </div>
                            <div class="m-widget17__stats">
                                <div class="m-widget17__items m-widget17__items-col1">
                                    <div class="m-widget17__item">
														<span class="m-widget17__icon">
															<i class="flaticon-users m--font-brand"></i>
														</span>
                                        <span class="m-widget17__subtitle">
															{{__('messages.customers')}}
														</span>
                                        <span class="m-widget17__desc">
															@if($data->customers->count() > 0){{$data->customers->count()}}@endif
                                            {{trans_choice('messages.customers_active', $data->customers->count())}}
														</span>
									</div>
                                    <div class="m-widget17__item">
														<span class="m-widget17__icon">
															<i class="flaticon-interface-7 m--font-info"></i>
														</span>
                                        <span class="m-widget17__subtitle">
															{{__('messages.providers')}}
														</span>
                                        <span class="m-widget17__desc">
                                                            @if($data->providers->count() > 0){{$data->providers->count()}}@endif
                                            {{trans_choice('messages.providers_active', $data->providers->count())}}
														</span>
                                    </div>
                                </div>
                                <div class="m-widget17__items m-widget17__items-col2">
                                    <div class="m-widget17__item">
                                        <span class="m-widget17__icon">
                                            <i class="flaticon-layers m--font-success"></i>
                                        </span>
                                        <span class="m-widget17__subtitle">
                                            {{__('messages.services')}}
                                        </span>
                                        <span class="m-widget17__desc">
                                            @if($data->services->count() > 0){{$data->services->count()}}@endif
                                            {{trans_choice('messages.services_active', $data->services->count())}}
                                        </span>
                                    </div>
                                    @if($dashboard['usersSummary'])
                                        <div class="m-widget17__item">
                                            <span class="m-widget17__icon">
                                                <i class="flaticon-profile m--font-danger"></i>
                                            </span>
                                            <span class="m-widget17__subtitle">
                                                {{__('messages.users')}}
                                            </span>
                                            <span class="m-widget17__desc">
                                                @if($dashboard['usersSummary']->count() > 0){{$dashboard['usersSummary']->count()}}@endif
                                                {{trans_choice('messages.users_active', $dashboard['usersSummary']->count())}}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--end:: Widgets/Activity-->
            </div>
        </div>

        <!--End::Section-->


        <!--Begin::Section-->
        <div class="row">
            <div class="col-xl-8">

                <!--begin::Portlet-->
                <div class="m-portlet" id="m_portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
												<span class="m-portlet__head-icon">
													<i class="flaticon-calendar"></i>
												</span>
                                <h3 class="m-portlet__head-text">
                                    {{__('messages.calendar')}}
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">
                                <li class="m-portlet__nav-item">
                                    <a href="{{route('services.create')}}"
                                       class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--pill">
														<span>
															<i class="la la-plus"></i>
															<span>{{__('messages.new_service')}}</span>
														</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div id="m_calendar"></div>
                    </div>
                </div>

                <!--end::Portlet-->
            </div>

            <div class="col-xl-4">

                <!--begin:: Widgets/Audit Log-->
                <div class="m-portlet m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon">
                                    <i class="flaticon-network"></i>
                                </span>
                                <h3 class="m-portlet__head-text">
                                    {{__('messages.services_status')}}
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <a class="btn m-btn--pill btn-secondary btn-sm m-btn"
                               href="{{route('services.index')}}">{{__('messages.all_services')}}</a>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-scrollable" data-scrollable="true" data-height="550" style="">
                            <div class="m-list-timeline m-list-timeline--skin-light">
                                <div class="m-list-timeline__items">
                                    @foreach($data->services as $service)
                                        @if($service->url)
                                            <div class="m-list-timeline__item">
                                                <span
                                                    class="m-list-timeline__badge @if($service->health == 1)m-list-timeline__badge--success @else m-list-timeline__badge--danger @endif"></span>
                                                <span class="m-list-timeline__text">{{$service->url}}</span>
                                                <span class="m-list-timeline__time">
                                                <span
                                                    class="m-badge m-badge--wide @if($service->health == 1) m-badge--success @else m-badge--danger @endif">@if($service->health == 1)
                                                        {{__('messages.online')}} @else {{__('messages.offline')}} @endif</span>
                                            </span>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--end:: Widgets/Audit Log-->
            </div>

        </div>
        <!--End::Section-->


        <!--Begin::Section-->

        <div class="row">

            @if(Auth::user()->isAdmin() && $dashboard['usersSummary'])
                <div class="col-xl-4">
            @else
                <div class="col-xl-6">
            @endif

                    <!--begin:: Widgets/Authors Profit-->
                        <div class="m-portlet m-portlet--full-height ">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon">
                                <i class="flaticon-interface-7"></i>
                            </span>
                                        <h3 class="m-portlet__head-text">
                                            {{__('messages.providers')}}
                                        </h3>
                                    </div>
                                </div>
                                <div class="m-portlet__head-tools">
                                    <a class="btn m-btn--pill btn-secondary btn-sm m-btn" href="{{route('providers.index')}}">
                                        {{__('messages.all_providers')}}
                                    </a>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                <div class="m-widget4">
                                    @foreach($data->providers as $provider)
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__img m-widget4__img--logo">
                                                <img src="{{$provider->screenshoot}}" alt="">
                                            </div>
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    {{$provider->name}}
                                                    @if($provider->website)
                                                        <br><a target="_blank" href="{{$provider->website}}">{{$provider->website}}</a>
                                                    @endif
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    @if($provider->services->count() > 0)
                                                        {{$provider->services->count()}}
                                                    @endif
                                                    {{trans_choice('messages.services_active', $provider->services->count())}}
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!--end:: Widgets/Authors Profit-->
                    </div>

            @if(Auth::user()->isAdmin() && $dashboard['usersSummary'])
                <div class="col-xl-4">
            @else
                <div class="col-xl-6">
            @endif

                    <!--begin:: Widgets/Authors Profit-->
                    <div class="m-portlet m-portlet--full-height ">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <span class="m-portlet__head-icon">
                                        <i class="flaticon-users"></i>
                                    </span>
                                    <h3 class="m-portlet__head-text">
                                        {{__('messages.customers')}}
                                    </h3>
                                </div>
                            </div>
                            <div class="m-portlet__head-tools">
                                <a class="btn m-btn--pill btn-secondary btn-sm m-btn"
                                    href="{{route('customers.index')}}">{{__('messages.all_customers')}}</a>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <div class="m-widget4">
                                @foreach($data->customers as $customer)
                                    <div class="m-widget4__item">
                                        <div class="m-widget4__info" style="padding-left: 0;">
                                            <span class="m-widget4__title">{{$customer->name}}</span>
                                            <br>
                                            <span class="m-widget4__sub">
                                                @if($customer->services->count() > 0){{$customer->services->count()}}@endif
                                                {{trans_choice('messages.services_active', $customer->services->count())}}
                                            </span>
                                        </div>
                                        <span class="m-widget4__ext">
                                            <span class="m-widget4__number m--font-brand">{{amount_format($customer->services_total_amount)}}</span>
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!--end:: Widgets/Authors Profit-->
                </div>

                        @if(Auth::user()->isAdmin() && $dashboard['usersSummary'])

                            <div class="col-xl-4">
                                <!--begin:: Widgets/User Progress -->
                                <div class="m-portlet m-portlet--full-height ">
                                    <div class="m-portlet__head">
                                        <div class="m-portlet__head-caption">
                                            <div class="m-portlet__head-title">
                                                <span class="m-portlet__head-icon">
                                                    <i class="flaticon-profile"></i>
                                                </span>
                                                <h3 class="m-portlet__head-text">
                                                    {{__('messages.users')}}
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="m-portlet__head-tools">
                                            <a class="btn m-btn--pill btn-secondary btn-sm m-btn"
                                               href="{{route('users.index')}}">{{__('messages.all_users')}}</a>
                                        </div>
                                    </div>
                                    <div class="m-portlet__body">

                                        <div class="m-widget4 m-widget4--progress">

                                            @foreach($dashboard['usersSummary'] as $user)
                                                <div class="m-widget4__item">
                                                    <div class="m-widget4__img m-widget4__img--pic">
                                                        <img src="{{$user->avatar}}" alt="">
                                                    </div>
                                                    <div class="m-widget4__info">
                                                        <span
                                                            class="m-widget4__title">{{$user->name}}</span><br>
                                                        <span class="m-widget4__sub">
                                                            @if($user->services->count() > 0){{$user->services->count()}}@endif
                                                            {{trans_choice('messages.services_active', $user->services->count())}}
                                                            <span class="m--font-boldest">({{amount_format($user->services_total_amount)}})</span>
                                                        </span>
                                                    </div>
                                                    <div class="m-widget4__progress">
                                                        <div class="m-widget4__progress-wrapper">
                                                            <span class="m-widget17__progress-number">{{$user->services_total_perc}}
                                                                %</span>
                                                            <div class="progress m-progress--sm">
                                                                <div class="progress-bar bg-danger"
                                                                     role="progressbar"
                                                                     style="width: {{$user->services_total_perc}}%;"
                                                                     aria-valuenow="25" aria-valuemin="0"
                                                                     aria-valuemax="100"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                </div>

                <!--End::Section-->

            </div>
@stop

@section('scripts')
    @parent
    <script>
        var dashboardServicesDataChart = [];
        @foreach($dashboard['servicesThisYear'] as $service)
            dashboardServicesDataChart.push({{$service}})
        @endforeach

        var dashboardEvents = [];
        @foreach ($data->services as $service)
            @foreach ($service->renewals as $renewal)
                dashboardEvents.push({
                    title: '{{$service->name}}',
                    url: '{{route('services.show', $service)}}',
                    start: moment('{{$renewal->deadline}}'),
                    description: '{{\App\Enums\RenewalSM::getDescription($renewal->getStateAttribute()['attr'])}}',
                    className: "m-fc-event--light m-fc-event--solid-{{$renewal->getStateAttribute()['label']}}",
                    allDay: true,
                });
            @endforeach
        @endforeach
    </script>
@stop
