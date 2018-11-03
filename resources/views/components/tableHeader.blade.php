<div class="m-portlet__head">
    <div class="m-portlet__head-caption">
        <div class="m-portlet__head-title">
            <span class="m-portlet__head-icon">
                <i class="{{$icon}}"></i>
            </span>
            <h3 class="m-portlet__head-text">{{$title}}</h3>
        </div>
    </div>
    <div class="m-portlet__head-tools">
        <ul class="m-portlet__nav">
            @if($url)
            <li class="m-portlet__nav-item">
                <a href="{{$url}}" data-target="{{$dataTarget}}" data-original-title="{{$button}}" class="@if($newModal)open-modal @endif btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                    <span>
                        <i class="la la-plus"></i>
                        <span>{{$button}}</span>
                    </span>
                </a>
            </li>
            @endif
            @if($moreAction)
                <li class="m-portlet__nav-item"></li>
                <li class="m-portlet__nav-item">
                    <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
                        <a href="#" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
                            <i class="la la-ellipsis-h m--font-brand"></i>
                        </a>
                        <div class="m-dropdown__wrapper">
                            <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                            <div class="m-dropdown__inner">
                                <div class="m-dropdown__body">
                                    <div class="m-dropdown__content">
                                        <ul class="m-nav">
                                            <li class="m-nav__section m-nav__section--first">
                                                <span class="m-nav__section-text">{{__('messages.quick_actions')}}</span>
                                            </li>
                                            {{$slot}}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            @endif
        </ul>
    </div>
</div>
