<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">{{$slot}}</h3>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="{{route('dashboard')}}" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-home"></i>
                        <span class="m-nav__link-text m--padding-left-10">{{__('messages.back_to_dashboard')}}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>