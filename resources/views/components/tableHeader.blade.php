<div class="m-portlet__head">
    <div class="m-portlet__head-caption">
        <div class="m-portlet__head-title">
            <span class="m-portlet__head-icon">
                <i class="{{$icon}}"></i>
            </span>
            <h3 class="m-portlet__head-text">{{$slot}}</h3>
        </div>
    </div>
    <div class="m-portlet__head-tools">
        <ul class="m-portlet__nav">
            <li class="m-portlet__nav-item">
                <a href="{{$url}}" class="new-record btn btn-primary m-btn m-btn--icon btn-lg m-btn--icon-only m-btn--pill" data-toggle="m-tooltip" data-placement="left" title="" data-original-title="{{$button}}">
                    <i class="la la-plus"></i>
                </a>
            </li>
        </ul>
    </div>
</div>
