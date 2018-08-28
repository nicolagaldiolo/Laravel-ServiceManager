@extends('layouts.app')

@section('content')
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">Dashboard</h3>
                <ul>
                    <li>Servizi attivi: {{$domains_sum}}</li>
                    <li>Fornitori attivi: {{$providers_sum}}</li>
                    <li>Utenti attivi: {{$user_sum}}</li>
                </ul>

            </div>
        </div>
    </div>

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
                                        <h3 class="m-widget1__title">Member Profit</h3>
                                        <span class="m-widget1__desc">Awerage Weekly Profit</span>
                                    </div>
                                    <div class="col m--align-right">
                                        <span class="m-widget1__number m--font-brand">+$17,800</span>
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
                                        <h3 class="m-widget1__title">Member Profit</h3>
                                        <span class="m-widget1__desc">Awerage Weekly Profit</span>
                                    </div>
                                    <div class="col m--align-right">
                                        <span class="m-widget1__number m--font-info">+$17,800</span>
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
                                        <h3 class="m-widget1__title">Member Profit</h3>
                                        <span class="m-widget1__desc">Awerage Weekly Profit</span>
                                    </div>
                                    <div class="col m--align-right">
                                        <span class="m-widget1__number m--font-danger">+$17,800</span>
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
                                        <h3 class="m-widget1__title">Member Profit</h3>
                                        <span class="m-widget1__desc">Awerage Weekly Profit</span>
                                    </div>
                                    <div class="col m--align-right">
                                        <span class="m-widget1__number m--font-success">+$17,800</span>
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
                                <h3 class="m-portlet__head-text">
                                    Domini in scadenza
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">
                                <li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
                                    <a href="{{route('domains.index')}}" class="m-portlet__nav-link btn btn--sm m-btn--pill btn-primary m-btn m-btn--label-brand">
                                        Tutti i servizi
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__body">

                        <!--begin::Widget5-->
                        <div class="m-widget4">
                            <div class="m-widget4__chart m-portlet-fit--sides m--margin-top-10 m--margin-top-20" style="height:260px;">
                                <canvas id="m_chart_trends_stats"></canvas>
                            </div>
                            <div class="m-widget4__item">
                                <div class="m-widget4__img m-widget4__img--logo">
                                    <img src="https://keenthemes.com/metronic/themes/themes/metronic/dist/preview/assets/app/media/img/client-logos/logo1.png" alt="">
                                </div>
                                <div class="m-widget4__info">
													<span class="m-widget4__title">
														Phyton
													</span>
                                    <br>
                                    <span class="m-widget4__sub">
														A Programming Language
													</span>
                                </div>
                                <span class="m-widget4__ext">
													<span class="m-widget4__number m--font-danger">+$17</span>
												</span>
                            </div>
                            <div class="m-widget4__item">
                                <div class="m-widget4__img m-widget4__img--logo">
                                    <img src="https://keenthemes.com/metronic/themes/themes/metronic/dist/preview/assets/app/media/img/client-logos/logo1.png" alt="">
                                </div>
                                <div class="m-widget4__info">
													<span class="m-widget4__title">
														FlyThemes
													</span>
                                    <br>
                                    <span class="m-widget4__sub">
														A Let's Fly Fast Again Language
													</span>
                                </div>
                                <span class="m-widget4__ext">
													<span class="m-widget4__number m--font-danger">+$300</span>
												</span>
                            </div>
                            <div class="m-widget4__item">
                                <div class="m-widget4__img m-widget4__img--logo">
                                    <img src="https://keenthemes.com/metronic/themes/themes/metronic/dist/preview/assets/app/media/img/client-logos/logo1.png" alt="">
                                </div>
                                <div class="m-widget4__info">
													<span class="m-widget4__title">
														AirApp
													</span>
                                    <br>
                                    <span class="m-widget4__sub">
														Awesome App For Project Management
													</span>
                                </div>
                                <span class="m-widget4__ext">
													<span class="m-widget4__number m--font-danger">+$6700</span>
												</span>
                            </div>
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
                                <h3 class="m-portlet__head-text m--font-light">
                                    Summary
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-widget17">
                            <div class="m-widget17__visual m-widget17__visual--chart m-portlet-fit--top m-portlet-fit--sides m--bg-danger">
                                <div class="m-widget17__chart" style="height:320px;">
                                    <canvas id="m_chart_activities"></canvas>
                                </div>
                            </div>
                            <div class="m-widget17__stats">
                                <div class="m-widget17__items m-widget17__items-col1">
                                    <div class="m-widget17__item">
														<span class="m-widget17__icon">
															<i class="flaticon-truck m--font-brand"></i>
														</span>
                                        <span class="m-widget17__subtitle">
															Delivered
														</span>
                                        <span class="m-widget17__desc">
															15 New Paskages
														</span>
                                    </div>
                                    <div class="m-widget17__item">
														<span class="m-widget17__icon">
															<i class="flaticon-paper-plane m--font-info"></i>
														</span>
                                        <span class="m-widget17__subtitle">
															Reporeted
														</span>
                                        <span class="m-widget17__desc">
															72 Support Cases
														</span>
                                    </div>
                                </div>
                                <div class="m-widget17__items m-widget17__items-col2">
                                    <div class="m-widget17__item">
														<span class="m-widget17__icon">
															<i class="flaticon-pie-chart m--font-success"></i>
														</span>
                                        <span class="m-widget17__subtitle">
															Ordered
														</span>
                                        <span class="m-widget17__desc">
															72 New Items
														</span>
                                    </div>
                                    <div class="m-widget17__item">
														<span class="m-widget17__icon">
															<i class="flaticon-time m--font-danger"></i>
														</span>
                                        <span class="m-widget17__subtitle">
															Arrived
														</span>
                                        <span class="m-widget17__desc">
															34 Upgraded Boxes
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
													<i class="flaticon-map-location"></i>
												</span>
                                <h3 class="m-portlet__head-text">
                                    Domains
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">
                                <li class="m-portlet__nav-item">
                                    <a href="{{route('domains.create')}}" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air">
														<span>
															<i class="la la-plus"></i>
															<span>Add Event</span>
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
                                <h3 class="m-portlet__head-text">
                                    Audit Log
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_widget4_tab1_content" role="tab">
                                        Today
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_widget4_tab2_content" role="tab">
                                        Week
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_widget4_tab3_content" role="tab">
                                        Month
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="m_widget4_tab1_content">
                                <div class="m-scrollable" data-scrollable="true" data-height="550" style="">
                                    <div class="m-list-timeline m-list-timeline--skin-light">
                                        <div class="m-list-timeline__items">
                                            <div class="m-list-timeline__item">
                                                <span class="m-list-timeline__badge m-list-timeline__badge--success"></span>
                                                <span class="m-list-timeline__text">12 new users registered</span>
                                                <span class="m-list-timeline__time">Just now</span>
                                            </div>
                                            <div class="m-list-timeline__item">
                                                <span class="m-list-timeline__badge m-list-timeline__badge--info"></span>
                                                <span class="m-list-timeline__text">System shutdown
																	<span class="m-badge m-badge--success m-badge--wide">pending</span>
																</span>
                                                <span class="m-list-timeline__time">14 mins</span>
                                            </div>
                                            <div class="m-list-timeline__item">
                                                <span class="m-list-timeline__badge m-list-timeline__badge--danger"></span>
                                                <span class="m-list-timeline__text">New invoice received</span>
                                                <span class="m-list-timeline__time">20 mins</span>
                                            </div>
                                            <div class="m-list-timeline__item">
                                                <span class="m-list-timeline__badge m-list-timeline__badge--accent"></span>
                                                <span class="m-list-timeline__text">DB overloaded 80%
																	<span class="m-badge m-badge--info m-badge--wide">settled</span>
																</span>
                                                <span class="m-list-timeline__time">1 hr</span>
                                            </div>
                                            <div class="m-list-timeline__item">
                                                <span class="m-list-timeline__badge m-list-timeline__badge--warning"></span>
                                                <span class="m-list-timeline__text">System error -
																	<a href="#" class="m-link">Check</a>
																</span>
                                                <span class="m-list-timeline__time">2 hrs</span>
                                            </div>
                                            <div class="m-list-timeline__item">
                                                <span class="m-list-timeline__badge m-list-timeline__badge--brand"></span>
                                                <span class="m-list-timeline__text">Production server down</span>
                                                <span class="m-list-timeline__time">3 hrs</span>
                                            </div>
                                            <div class="m-list-timeline__item">
                                                <span class="m-list-timeline__badge m-list-timeline__badge--info"></span>
                                                <span class="m-list-timeline__text">Production server up</span>
                                                <span class="m-list-timeline__time">5 hrs</span>
                                            </div>
                                            <div class="m-list-timeline__item">
                                                <span class="m-list-timeline__badge m-list-timeline__badge--success"></span>
                                                <span href="" class="m-list-timeline__text">New order received
																	<span class="m-badge m-badge--danger m-badge--wide">urgent</span>
																</span>
                                                <span class="m-list-timeline__time">7 hrs</span>
                                            </div>
                                            <div class="m-list-timeline__item">
                                                <span class="m-list-timeline__badge m-list-timeline__badge--success"></span>
                                                <span class="m-list-timeline__text">12 new users registered</span>
                                                <span class="m-list-timeline__time">Just now</span>
                                            </div>
                                            <div class="m-list-timeline__item">
                                                <span class="m-list-timeline__badge m-list-timeline__badge--info"></span>
                                                <span class="m-list-timeline__text">System shutdown
																	<span class="m-badge m-badge--success m-badge--wide">pending</span>
																</span>
                                                <span class="m-list-timeline__time">14 mins</span>
                                            </div>
                                            <div class="m-list-timeline__item">
                                                <span class="m-list-timeline__badge m-list-timeline__badge--danger"></span>
                                                <span class="m-list-timeline__text">New invoice received</span>
                                                <span class="m-list-timeline__time">20 mins</span>
                                            </div>
                                            <div class="m-list-timeline__item">
                                                <span class="m-list-timeline__badge m-list-timeline__badge--accent"></span>
                                                <span class="m-list-timeline__text">DB overloaded 80%
																	<span class="m-badge m-badge--info m-badge--wide">settled</span>
																</span>
                                                <span class="m-list-timeline__time">1 hr</span>
                                            </div>
                                            <div class="m-list-timeline__item">
                                                <span class="m-list-timeline__badge m-list-timeline__badge--danger"></span>
                                                <span class="m-list-timeline__text">New invoice received</span>
                                                <span class="m-list-timeline__time">20 mins</span>
                                            </div>
                                            <div class="m-list-timeline__item">
                                                <span class="m-list-timeline__badge m-list-timeline__badge--accent"></span>
                                                <span class="m-list-timeline__text">DB overloaded 80%
																	<span class="m-badge m-badge--info m-badge--wide">settled</span>
																</span>
                                                <span class="m-list-timeline__time">1 hr</span>
                                            </div>
                                            <div class="m-list-timeline__item">
                                                <span class="m-list-timeline__badge m-list-timeline__badge--warning"></span>
                                                <span class="m-list-timeline__text">System error -
																	<a href="#" class="m-link">Check</a>
																</span>
                                                <span class="m-list-timeline__time">2 hrs</span>
                                            </div>
                                            <div class="m-list-timeline__item">
                                                <span class="m-list-timeline__badge m-list-timeline__badge--brand"></span>
                                                <span class="m-list-timeline__text">Production server down</span>
                                                <span class="m-list-timeline__time">3 hrs</span>
                                            </div>
                                            <div class="m-list-timeline__item">
                                                <span class="m-list-timeline__badge m-list-timeline__badge--info"></span>
                                                <span class="m-list-timeline__text">Production server up</span>
                                                <span class="m-list-timeline__time">5 hrs</span>
                                            </div>
                                            <div class="m-list-timeline__item">
                                                <span class="m-list-timeline__badge m-list-timeline__badge--success"></span>
                                                <span href="" class="m-list-timeline__text">New order received
																	<span class="m-badge m-badge--danger m-badge--wide">urgent</span>
																</span>
                                                <span class="m-list-timeline__time">7 hrs</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="m_widget4_tab2_content">
                            </div>
                            <div class="tab-pane" id="m_widget4_tab3_content">
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

            <div class="col-xl-4">

                <!--begin:: Widgets/Authors Profit-->
                <div class="m-portlet m-portlet--bordered-semi m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Authors Profit
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">
                                <li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover">
                                    <a href="#" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn--sm m-btn--pill btn-secondary m-btn m-btn--label-brand">
                                        All
                                    </a>
                                    <div class="m-dropdown__wrapper">
                                        <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                        <div class="m-dropdown__inner">
                                            <div class="m-dropdown__body">
                                                <div class="m-dropdown__content">
                                                    <ul class="m-nav">
                                                        <li class="m-nav__section m-nav__section--first">
                                                            <span class="m-nav__section-text">Quick Actions</span>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-share"></i>
                                                                <span class="m-nav__link-text">Activity</span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-chat-1"></i>
                                                                <span class="m-nav__link-text">Messages</span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-info"></i>
                                                                <span class="m-nav__link-text">FAQ</span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                                                <span class="m-nav__link-text">Support</span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__separator m-nav__separator--fit">
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="#" class="btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm">Cancel</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-widget4">
                            <div class="m-widget4__item">
                                <div class="m-widget4__img m-widget4__img--logo">
                                    <img src="https://keenthemes.com/metronic/themes/themes/metronic/dist/preview/assets/app/media/img/client-logos/logo4.png" alt="">
                                </div>
                                <div class="m-widget4__info">
													<span class="m-widget4__title">
														Trump Themes
													</span>
                                    <br>
                                    <span class="m-widget4__sub">
														Make Metronic Great Again
													</span>
                                </div>
                                <span class="m-widget4__ext">
													<span class="m-widget4__number m--font-brand">+$2500</span>
												</span>
                            </div>
                            <div class="m-widget4__item">
                                <div class="m-widget4__img m-widget4__img--logo">
                                    <img src="https://keenthemes.com/metronic/themes/themes/metronic/dist/preview/assets/app/media/img/client-logos/logo4.png" alt="">
                                </div>
                                <div class="m-widget4__info">
													<span class="m-widget4__title">
														StarBucks
													</span>
                                    <br>
                                    <span class="m-widget4__sub">
														Good Coffee & Snacks
													</span>
                                </div>
                                <span class="m-widget4__ext">
													<span class="m-widget4__number m--font-brand">-$290</span>
												</span>
                            </div>
                            <div class="m-widget4__item">
                                <div class="m-widget4__img m-widget4__img--logo">
                                    <img src="https://keenthemes.com/metronic/themes/themes/metronic/dist/preview/assets/app/media/img/client-logos/logo4.png" alt="">
                                </div>
                                <div class="m-widget4__info">
													<span class="m-widget4__title">
														Phyton
													</span>
                                    <br>
                                    <span class="m-widget4__sub">
														A Programming Language
													</span>
                                </div>
                                <span class="m-widget4__ext">
													<span class="m-widget4__number m--font-brand">+$17</span>
												</span>
                            </div>
                            <div class="m-widget4__item">
                                <div class="m-widget4__img m-widget4__img--logo">
                                    <img src="https://keenthemes.com/metronic/themes/themes/metronic/dist/preview/assets/app/media/img/client-logos/logo4.png" alt="">
                                </div>
                                <div class="m-widget4__info">
													<span class="m-widget4__title">
														GreenMakers
													</span>
                                    <br>
                                    <span class="m-widget4__sub">
														Make Green Great Again
													</span>
                                </div>
                                <span class="m-widget4__ext">
													<span class="m-widget4__number m--font-brand">-$2.50</span>
												</span>
                            </div>
                            <div class="m-widget4__item">
                                <div class="m-widget4__img m-widget4__img--logo">
                                    <img src="https://keenthemes.com/metronic/themes/themes/metronic/dist/preview/assets/app/media/img/client-logos/logo4.png" alt="">
                                </div>
                                <div class="m-widget4__info">
													<span class="m-widget4__title">
														FlyThemes
													</span>
                                    <br>
                                    <span class="m-widget4__sub">
														A Let's Fly Fast Again Language
													</span>
                                </div>
                                <span class="m-widget4__ext">
													<span class="m-widget4__number m--font-brand">+$200</span>
												</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!--end:: Widgets/Authors Profit-->
            </div>

            <div class="col-xl-4">

                <!--begin:: Widgets/Authors Profit-->
                <div class="m-portlet m-portlet--bordered-semi m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Authors Profit
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">
                                <li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover">
                                    <a href="#" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn--sm m-btn--pill btn-secondary m-btn m-btn--label-brand">
                                        All
                                    </a>
                                    <div class="m-dropdown__wrapper">
                                        <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                        <div class="m-dropdown__inner">
                                            <div class="m-dropdown__body">
                                                <div class="m-dropdown__content">
                                                    <ul class="m-nav">
                                                        <li class="m-nav__section m-nav__section--first">
                                                            <span class="m-nav__section-text">Quick Actions</span>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-share"></i>
                                                                <span class="m-nav__link-text">Activity</span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-chat-1"></i>
                                                                <span class="m-nav__link-text">Messages</span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-info"></i>
                                                                <span class="m-nav__link-text">FAQ</span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                                                <span class="m-nav__link-text">Support</span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__separator m-nav__separator--fit">
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="#" class="btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm">Cancel</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-widget4">
                            <div class="m-widget4__item">
                                <div class="m-widget4__img m-widget4__img--logo">
                                    <img src="https://keenthemes.com/metronic/themes/themes/metronic/dist/preview/assets/app/media/img/client-logos/logo4.png" alt="">
                                </div>
                                <div class="m-widget4__info">
													<span class="m-widget4__title">
														Trump Themes
													</span>
                                    <br>
                                    <span class="m-widget4__sub">
														Make Metronic Great Again
													</span>
                                </div>
                                <span class="m-widget4__ext">
													<span class="m-widget4__number m--font-brand">+$2500</span>
												</span>
                            </div>
                            <div class="m-widget4__item">
                                <div class="m-widget4__img m-widget4__img--logo">
                                    <img src="https://keenthemes.com/metronic/themes/themes/metronic/dist/preview/assets/app/media/img/client-logos/logo4.png" alt="">
                                </div>
                                <div class="m-widget4__info">
													<span class="m-widget4__title">
														StarBucks
													</span>
                                    <br>
                                    <span class="m-widget4__sub">
														Good Coffee & Snacks
													</span>
                                </div>
                                <span class="m-widget4__ext">
													<span class="m-widget4__number m--font-brand">-$290</span>
												</span>
                            </div>
                            <div class="m-widget4__item">
                                <div class="m-widget4__img m-widget4__img--logo">
                                    <img src="https://keenthemes.com/metronic/themes/themes/metronic/dist/preview/assets/app/media/img/client-logos/logo4.png" alt="">
                                </div>
                                <div class="m-widget4__info">
													<span class="m-widget4__title">
														Phyton
													</span>
                                    <br>
                                    <span class="m-widget4__sub">
														A Programming Language
													</span>
                                </div>
                                <span class="m-widget4__ext">
													<span class="m-widget4__number m--font-brand">+$17</span>
												</span>
                            </div>
                            <div class="m-widget4__item">
                                <div class="m-widget4__img m-widget4__img--logo">
                                    <img src="https://keenthemes.com/metronic/themes/themes/metronic/dist/preview/assets/app/media/img/client-logos/logo4.png" alt="">
                                </div>
                                <div class="m-widget4__info">
													<span class="m-widget4__title">
														GreenMakers
													</span>
                                    <br>
                                    <span class="m-widget4__sub">
														Make Green Great Again
													</span>
                                </div>
                                <span class="m-widget4__ext">
													<span class="m-widget4__number m--font-brand">-$2.50</span>
												</span>
                            </div>
                            <div class="m-widget4__item">
                                <div class="m-widget4__img m-widget4__img--logo">
                                    <img src="https://keenthemes.com/metronic/themes/themes/metronic/dist/preview/assets/app/media/img/client-logos/logo4.png" alt="">
                                </div>
                                <div class="m-widget4__info">
													<span class="m-widget4__title">
														FlyThemes
													</span>
                                    <br>
                                    <span class="m-widget4__sub">
														A Let's Fly Fast Again Language
													</span>
                                </div>
                                <span class="m-widget4__ext">
													<span class="m-widget4__number m--font-brand">+$200</span>
												</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!--end:: Widgets/Authors Profit-->
            </div>

            <div class="col-xl-4">
                <!--begin:: Widgets/User Progress -->
                <div class="m-portlet m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    User Progress
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_widget4_tab1_content" role="tab">
                                        Today
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_widget4_tab2_content" role="tab">
                                        Week
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_widget4_tab3_content" role="tab">
                                        Month
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="m_widget4_tab1_content">
                                <div class="m-widget4 m-widget4--progress">
                                    <div class="m-widget4__item">
                                        <div class="m-widget4__img m-widget4__img--pic">
                                            <img src="https://keenthemes.com/metronic/themes/themes/metronic/dist/preview/assets/app/media/img/users/100_14.jpg" alt="">
                                        </div>
                                        <div class="m-widget4__info">
							                <span class="m-widget4__title">Anna Strong</span><br>
                                            <span class="m-widget4__sub">Visual Designer,Google Inc</span>
                                        </div>
                                        <div class="m-widget4__progress">
                                            <div class="m-widget4__progress-wrapper">
                                                <span class="m-widget17__progress-number">63%</span>
                                                <span class="m-widget17__progress-label">London</span>
                                                <div class="progress m-progress--sm">
                                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 63%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="63"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="m-widget4__item">
                                        <div class="m-widget4__img m-widget4__img--pic">
                                            <img src="https://keenthemes.com/metronic/themes/themes/metronic/dist/preview/assets/app/media/img/users/100_14.jpg" alt="">
                                        </div>
                                        <div class="m-widget4__info">
                                            <span class="m-widget4__title">Anna Strong</span><br>
                                            <span class="m-widget4__sub">Visual Designer,Google Inc</span>
                                        </div>
                                        <div class="m-widget4__progress">
                                            <div class="m-widget4__progress-wrapper">
                                                <span class="m-widget17__progress-number">63%</span>
                                                <span class="m-widget17__progress-label">London</span>
                                                <div class="progress m-progress--sm">
                                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 63%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="63"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="m-widget4__item">
                                        <div class="m-widget4__img m-widget4__img--pic">
                                            <img src="https://keenthemes.com/metronic/themes/themes/metronic/dist/preview/assets/app/media/img/users/100_14.jpg" alt="">
                                        </div>
                                        <div class="m-widget4__info">
                                            <span class="m-widget4__title">Anna Strong</span><br>
                                            <span class="m-widget4__sub">Visual Designer,Google Inc</span>
                                        </div>
                                        <div class="m-widget4__progress">
                                            <div class="m-widget4__progress-wrapper">
                                                <span class="m-widget17__progress-number">63%</span>
                                                <span class="m-widget17__progress-label">London</span>
                                                <div class="progress m-progress--sm">
                                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 63%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="63"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="m-widget4__item">
                                        <div class="m-widget4__img m-widget4__img--pic">
                                            <img src="https://keenthemes.com/metronic/themes/themes/metronic/dist/preview/assets/app/media/img/users/100_14.jpg" alt="">
                                        </div>
                                        <div class="m-widget4__info">
                                            <span class="m-widget4__title">Anna Strong</span><br>
                                            <span class="m-widget4__sub">Visual Designer,Google Inc</span>
                                        </div>
                                        <div class="m-widget4__progress">
                                            <div class="m-widget4__progress-wrapper">
                                                <span class="m-widget17__progress-number">63%</span>
                                                <span class="m-widget17__progress-label">London</span>
                                                <div class="progress m-progress--sm">
                                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 63%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="63"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="tab-pane" id="m_widget4_tab2_content">
                            </div>
                            <div class="tab-pane" id="m_widget4_tab3_content">
                            </div>
                        </div>
                    </div>
                </div>
                <!--end:: Widgets/User Progress -->  </div>

        </div>

        <!--End::Section-->


    </div>
@stop

@section('scripts')
    @parent

    <script>
        jQuery(document).ready(function() {
            var calendarInit = function($) {
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
                        @foreach ($domains_calendar as $domain)
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

                    eventRender: function(event, element) {
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
            }(jQuery)
        });
    </script>

@stop
