@extends('layouts.app')

@section('content')

    {{--dd($dashboard->expiringDomains)--}}

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
                                        <h3 class="m-widget1__title">{{__('messages.total_revenue')}}</h3>
                                        <span class="m-widget1__desc">{{__(trans('messages.obtained_from', [ 'attribute' => $dashboard->domains->count() ]))}}</span>
                                        <br>
                                        <span class="m-widget1__number m--font-brand">&euro; {{$dashboard->domains->sum('amount')}}</span>
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
                                        <h3 class="m-widget1__title">
                                            {{__('messages.revenues')}}  {{\Carbon\Carbon::now()->format('F Y')}}</h3>
                                        <span class="m-widget1__desc">{{__(trans('messages.obtained_from', [ 'attribute' => $dashboard->expiringDomains->count() ]))}}</span>
                                        <br>
                                        <span class="m-widget1__number m--font-info">&euro; {{$dashboard->expiringDomains->sum('amount')}}</span>
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
                                        <span class="m-widget1__desc">{{__('messages.pending_payment')}}</span>
                                        <br>
                                        <span class="m-widget1__number m--font-danger">{{$domainsToPayCount}}</span>
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
                                        <span class="m-widget1__number m--font-success">{{$dashboard->monthlyService_percent}}%</span>
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
                                    {{__('messages.annual_trend')}}
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">
                                <li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push"
                                    m-dropdown-toggle="hover" aria-expanded="true">
                                    <a href="{{route('domains.index')}}"
                                       class="m-portlet__nav-link btn btn--sm m-btn--pill btn-brand m-btn">
                                        {{__('messages.all_domains')}}
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

                                @if($domainsToPay->isEmpty())
                                    <div class="alert alert-brand" role="alert">
                                        <strong>{{__('messages.fantastic')}}</strong> {{__('messages.no_other_domains')}}
                                    </div>
                                @else

                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table">
                                            <!--begin::Thead-->
                                            <thead>
                                            <tr>
                                                <td class="m-widget11__label"></td>
                                                <td class="m-widget11__app">{{__('messages.domain')}}</td>
                                                <td class="m-widget11__sales">{{__('messages.status')}}</td>
                                                <td class="m-widget11__price m--align-right">{{__('messages.amount')}}</td>
                                                <td class="m-widget11__total m--align-right"></td>
                                            </tr>
                                            </thead>
                                            <!--end::Thead-->
                                            <!--begin::Tbody-->
                                            <tbody>
                                            @foreach($domainsToPay as $domain)

                                                <tr>
                                                    <td>
                                                        <img src="{{$domain->screenshoot}}" alt="">
                                                    </td>
                                                    <td>
                                                        <span class="m-widget11__title">{{$domain->url}}</span>
                                                        <span class="m-widget11__sub">{{$domain->customer->name}}</span>
                                                    </td>
                                                    <td>
                                                        {{$domain->deadline->diffForHumans()}}
                                                    </td>
                                                    <td class="m--align-right m--font-brand amount">&euro; {{$domain->amount}}</td>
                                                    <td class="m--align-right">
                                                        @if(!$domain->payed)
                                                            <a href="{{route('domains.edit', $domain)}}"
                                                               class="btn m-btn--pill btn-outline-brand m-btn btn-sm">{{__('messages.edit')}}</a>
                                                        @endif
                                                    </td>

                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <!--end::Tbody-->
                                        </table>
                                        <!--end::Table-->
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
                <div class="m-portlet m-portlet--bordered-semi m-portlet--widget-fit m-portlet--full-height m-portlet--skin-light  m-portlet--rounded-force">
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
                            <div class="m-widget17__visual m-widget17__visual--chart m-portlet-fit--top m-portlet-fit--sides m--bg-danger">
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
															@if($dashboard->customers->count() > 0){{$dashboard->customers->count()}}@endif
                                                            {{trans_choice('messages.customers_active', $dashboard->customers->count())}}
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
                                                            @if($dashboard->providers->count() > 0){{$dashboard->providers->count()}}@endif
															{{trans_choice('messages.providers_active', $dashboard->providers->count())}}
														</span>
                                    </div>
                                </div>
                                <div class="m-widget17__items m-widget17__items-col2">
                                    <div class="m-widget17__item">
														<span class="m-widget17__icon">
															<i class="flaticon-layers m--font-success"></i>
														</span>
                                        <span class="m-widget17__subtitle">
															{{__('messages.domains')}}
														</span>
                                        <span class="m-widget17__desc">
                                                            @if($dashboard->domains->count() > 0){{$dashboard->domains->count()}}@endif
															{{trans_choice('messages.domains_active', $dashboard->domains->count())}}
														</span>
                                    </div>
                                    <div class="m-widget17__item">
														<span class="m-widget17__icon">
															<i class="flaticon-profile m--font-danger"></i>
														</span>
                                        <span class="m-widget17__subtitle">
															{{__('messages.users')}}
														</span>
                                        <span class="m-widget17__desc">
                                                            @if($dashboard->usersSummary->count() > 0){{$dashboard->usersSummary->count()}}@endif
                                                            {{trans_choice('messages.users_active', $dashboard->usersSummary->count())}}
														</span>
                                    </div>
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
                                    <a href="{{route('domains.create')}}"
                                       class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--pill">
														<span>
															<i class="la la-plus"></i>
															<span>{{__('messages.new_domain')}}</span>
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
                                    {{__('messages.domains_status')}}
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <a class="btn m-btn--pill btn-secondary btn-sm m-btn" href="{{route('domains.index')}}">{{__('messages.all_domains')}}</a>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-scrollable" data-scrollable="true" data-height="550" style="">
                            <div class="m-list-timeline m-list-timeline--skin-light">
                                <div class="m-list-timeline__items">
                                    @foreach($dashboard->domains as $domain)
                                        <div class="m-list-timeline__item">
                                            <span class="m-list-timeline__badge @if($domain->status == 1)m-list-timeline__badge--success @else m-list-timeline__badge--danger @endif"></span>
                                            <span class="m-list-timeline__text">{{$domain->url}}</span>
                                            <span class="m-list-timeline__time">
                                            <span class="m-badge m-badge--wide @if($domain->status == 1) m-badge--success @else m-badge--danger @endif">@if($domain->status == 1)
                                                    {{__('messages.online')}} @else {{__('messages.offline')}} @endif</span>
                                        </span>
                                        </div>
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

            @if(Auth::user()->isAdmin())
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
                            <a class="btn m-btn--pill btn-secondary btn-sm m-btn" href="{{route('providers.index')}}">{{__('messages.all_providers')}}</a>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-widget4">
                            @foreach($dashboard->providers as $provider)
                                <div class="m-widget4__item">
                                    <div class="m-widget4__img m-widget4__img--logo">
                                        <img src="{{$provider->screenshoot}}" alt="">
                                    </div>
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title">
                                            {{$provider->name}}<br>
                                            <a target="_blank" href="{{$provider->website}}">{{$provider->website}}</a>
                                        </span>
                                        <br>
                                        <span class="m-widget4__sub">
                                            @if($provider->domains->count() > 0){{$provider->domains->count()}}@endif
                                            {{trans_choice('messages.domains_active', $provider->domains->count())}} |
                                            @if($provider->hostings->count() > 0){{$provider->hostings->count()}}@endif
                                            {{trans_choice('messages.hostings_active', $provider->hostings->count())}}
                                        </span>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

                <!--end:: Widgets/Authors Profit-->
            </div>

            @if(Auth::user()->isAdmin())
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
                                        @foreach($dashboard->customers as $customer)
                                            <div class="m-widget4__item">
                                                <div class="m-widget4__info" style="padding-left: 0;">
                                                    <span class="m-widget4__title">{{$customer->name}}</span>
                                                    <br>
                                                    <span class="m-widget4__sub">
                                                        @if($customer->domains->count() > 0){{$customer->domains->count()}}@endif
                                                        {{trans_choice('messages.domains_active', $customer->domains->count())}}
                                                    </span>
                                                </div>
                                                <span class="m-widget4__ext">
                                        <span class="m-widget4__number m--font-brand">&euro; {{$customer->domains->sum('amount')}}</span>
                                    </span>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>

                            <!--end:: Widgets/Authors Profit-->
                        </div>

                        @if(Auth::user()->isAdmin())
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
                                            @foreach($dashboard->usersSummary as $user)
                                                <div class="m-widget4__item">
                                                    <div class="m-widget4__img m-widget4__img--pic">
                                                        <img src="{{$user->avatar}}" alt="">
                                                    </div>
                                                    <div class="m-widget4__info">
                                                        <span class="m-widget4__title">{{$user->name}}</span><br>
                                                        <span class="m-widget4__sub">
                                                            @if($user->domains->count() > 0){{$user->domains->count()}}@endif
                                                            {{trans_choice('messages.domains_active', $user->domains->count())}} (&euro; {{$user->domains->sum('amount')}})
                                                        </span>
                                                    </div>
                                                    <div class="m-widget4__progress">
                                                        <div class="m-widget4__progress-wrapper">
                                                            <span class="m-widget17__progress-number">{{$user->domains_total_perc}}%</span>
                                                            <div class="progress m-progress--sm">
                                                                <div class="progress-bar bg-danger" role="progressbar"
                                                                     style="width: {{$user->domains_total_perc}}%;"
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
                                <!--end:: Widgets/User Progress -->  </div>
                        @endif

                </div>

                <!--End::Section-->

        </div>
        @stop

        @section('scripts')
            @parent

            <script>
                jQuery(document).ready(function () {


                    //== Activities Charts.
                    //** Based on Chartjs plugin - http://www.chartjs.org/
                    var activitiesChart = function activitiesChart($) {
                        if ($('#m_chart_activities').length == 0) {
                            return;
                        }

                        var ctx = document.getElementById("m_chart_activities").getContext("2d");

                        var gradient = ctx.createLinearGradient(0, 0, 0, 240);
                        gradient.addColorStop(0, Chart.helpers.color('#00c5dc').alpha(0.7).rgbString());
                        gradient.addColorStop(1, Chart.helpers.color('#f2feff').alpha(0).rgbString());

                        var domainsData = [];
                        @foreach($dashboard->domainsByMounth as $domain)
                            domainsData.push({{$domain}})
                        @endforeach

                        var config = {
                                type: 'line',
                                data: {
                                    labels: [
                                        "{{__('messages.january')}}",
                                        "{{__('messages.february')}}",
                                        "{{__('messages.march')}}",
                                        "{{__('messages.april')}}",
                                        "{{__('messages.may')}}",
                                        "{{__('messages.june')}}",
                                        "{{__('messages.july')}}",
                                        "{{__('messages.august')}}",
                                        "{{__('messages.september')}}",
                                        "{{__('messages.october')}}",
                                        "{{__('messages.november')}}",
                                        "{{__('messages.december')}}"
                                    ],
                                    datasets: [{
                                        label: "{{__('messages.total_earning')}}",
                                        backgroundColor: gradient, // Put the gradient here as a fill color
                                        borderColor: '#0dc8de',

                                        pointBackgroundColor: Chart.helpers.color('#ffffff').alpha(0).rgbString(),
                                        pointBorderColor: Chart.helpers.color('#ffffff').alpha(0).rgbString(),
                                        pointHoverBackgroundColor: mApp.getColor('danger'),
                                        pointHoverBorderColor: Chart.helpers.color('#000000').alpha(0.2).rgbString(),

                                        //fill: 'start',
                                        data: domainsData
                                    }]
                                },
                                options: {
                                    title: {
                                        display: false
                                    },
                                    tooltips: {
                                        mode: 'nearest',
                                        intersect: false,
                                        position: 'nearest',
                                        xPadding: 10,
                                        yPadding: 10,
                                        caretPadding: 10
                                    },
                                    legend: {
                                        display: false
                                    },
                                    responsive: true,
                                    maintainAspectRatio: false,
                                    scales: {
                                        xAxes: [{
                                            display: false,
                                            gridLines: false,
                                            scaleLabel: {
                                                display: true,
                                                labelString: 'Month'
                                            }
                                        }],
                                        yAxes: [{
                                            display: false,
                                            gridLines: false,
                                            scaleLabel: {
                                                display: true,
                                                labelString: 'Value'
                                            },
                                            ticks: {
                                                beginAtZero: true
                                            }
                                        }]
                                    },
                                    elements: {
                                        line: {
                                            tension: 0.0000001
                                        },
                                        point: {
                                            radius: 4,
                                            borderWidth: 12
                                        }
                                    },
                                    layout: {
                                        padding: {
                                            left: 0,
                                            right: 0,
                                            top: 10,
                                            bottom: 0
                                        }
                                    }
                                }
                            };

                        var chart = new Chart(ctx, config);
                    }(jQuery);

                    var calendarInit = function ($) {
                        if ($('#m_calendar').length === 0) {
                            return;
                        }

                        var todayDate = moment().startOf('day');
                        var YM = todayDate.format('YYYY-MM');
                        var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
                        var TODAY = todayDate.format('YYYY-MM-DD');
                        var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');

                        $('#m_calendar').fullCalendar({
                            isRTL: mUtil.isRTL(),
                            header: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'month,agendaWeek,agendaDay,listWeek'
                            },
                            editable: true,
                            eventLimit: true, // allow "more" link when too many events
                            navLinks: true,
                            //defaultDate: moment('2018-08-15'),
                            events: [
                                    @foreach ($dashboard->domains as $domain)
                                {
                                    title: '{{$domain->url}}',
                                    url: '{{route('domains.edit', $domain)}}',
                                    start: moment('{{$domain->deadline}}'),
                                    description: '{{$domain->note}}',
                                    className: "m-fc-event--light m-fc-event--solid-primary",
                                    allDay: true,
                                },
                                @endforeach
                            ],

                            eventRender: function (event, element) {
                                if (element.hasClass('fc-day-grid-event')) {
                                    element.data('content', event.description);
                                    element.data('placement', 'top');
                                    mApp.initPopover(element);
                                } else if (element.hasClass('fc-time-grid-event')) {
                                    element.find('.fc-title').append('<div class="fc-description">' + event.description + '</div>');
                                } else if (element.find('.fc-list-item-title').lenght !== 0) {
                                    element.find('.fc-list-item-title').append('<div class="fc-description">' + event.description + '</div>');
                                }
                            }
                        });
                    }(jQuery);

                });
            </script>

@stop
