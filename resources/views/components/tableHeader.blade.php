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
                <a href="{{$url}}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon">
                    <span>
                        <i class="la la-plus-circle"></i>
                        <span>{{$button}}</span>
                    </span>
                </a>
            </li>
        </ul>
    </div>
</div>