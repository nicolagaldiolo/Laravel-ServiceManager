<!-- BEGIN: Left Aside -->
<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
    <i class="la la-close"></i>
</button>
<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">

    <!-- BEGIN: Aside Menu -->
    <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark "
         m-menu-vertical="1" m-menu-scrollable="1" m-menu-dropdown-timeout="500" style="position: relative;">
        <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">

            <li class="m-menu__item {{ Active::checkRoute('dashboard') }}" aria-haspopup="true">
                <a href="{{route('dashboard')}}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-line-graph"></i>
                    <span class="m-menu__link-title">
                                        <span class="m-menu__link-wrap">
                                            <span class="m-menu__link-text">{{__('messages.dashboard')}}</span>
                                            @if($feesToPayCount > 0)
                                                <span class="m-menu__link-badge">
                                                    <span class="m-badge m-badge--danger">{{$feesToPayCount}}</span>
                                                </span>
                                            @endif
                                        </span>
                                    </span>
                </a>
            </li>

            <li class="m-menu__section">
                <h4 class="m-menu__section-text">{{__('messages.actions')}}</h4>
                <i class="m-menu__section-icon flaticon-more-v3"></i>
            </li>
            <li class="m-menu__item  m-menu__item--submenu {{ Active::checkRoute('services.*') }}" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-layers"></i>
                    <span class="m-menu__link-text">{{__('messages.services')}}</span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu ">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item " aria-haspopup="true">
                            <a href="{{route('services.index')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">{{__('messages.all_services')}}</span>
                            </a>
                        </li>
                        <li class="m-menu__item " aria-haspopup="true">
                            <a href="{{route('services.create')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">{{__('messages.new_service')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="m-menu__item  m-menu__item--submenu {{ Active::checkRoute('customers.*') }}" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-users"></i>
                    <span class="m-menu__link-text">{{__('messages.customers')}}</span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu ">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true">
                                            <span class="m-menu__link">
                                                <span class="m-menu__link-text">{{__('messages.customers')}}</span>
                                            </span>
                        </li>
                        <li class="m-menu__item " aria-haspopup="true">
                            <a href="{{route('customers.index')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">{{__('messages.all_customers')}}</span>
                            </a>
                        </li>
                        <li class="m-menu__item " aria-haspopup="true">
                            <a href="{{route('customers.create')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">{{__('messages.new_customer')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="m-menu__item  m-menu__item--submenu {{ Active::checkRoute('providers.*') }}" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-interface-7"></i>
                    <span class="m-menu__link-text">{{__('messages.providers')}}</span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu ">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item " aria-haspopup="true">
                            <a href="{{route('providers.index')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">{{__('messages.all_providers')}}</span>
                            </a>
                        </li>
                        <li class="m-menu__item " aria-haspopup="true">
                            <a href="{{route('providers.create')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">{{__('messages.new_provider')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @if (Auth::user()->isAdmin())
                <li class="m-menu__item  m-menu__item--submenu {{ Active::checkRoute('users.*') }}" aria-haspopup="true" m-menu-submenu-toggle="hover">

                    <a href="{{route('users.index')}}" class="m-menu__link ">
                        <i class="m-menu__link-icon flaticon-profile"></i>
                        <span class="m-menu__link-title">
                            <span class="m-menu__link-wrap">
                                <span class="m-menu__link-text">{{__('messages.users')}}</span>
                            </span>
                        </span>
                    </a>
                </li>
            @endif

            <li class="m-menu__section ">
                <h4 class="m-menu__section-text">{{__('messages.registries')}}</h4>
                <i class="m-menu__section-icon flaticon-more-v3"></i>
            </li>

            <li class="m-menu__item {{ Active::checkRoute('service-types.*') }}" aria-haspopup="true">
                <a href="{{route('service-types.index')}}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-interface-6"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">{{__('messages.service_types')}}</span>
                        </span>
                    </span>
                </a>
            </li>

            <li class="m-menu__item {{ Active::checkRoute('renewal-frequencies.*') }}" aria-haspopup="true">
                <a href="{{route('renewal-frequencies.index')}}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-calendar"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">{{__('messages.renewal_frequencies')}}</span>
                        </span>
                    </span>
                </a>
            </li>

        </ul>
    </div>
    <!-- END: Aside Menu -->
</div>
<!-- END: Left Aside -->
