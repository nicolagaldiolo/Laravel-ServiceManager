<!--begin::Modal-->
<div class="modal fade" id="app_modal_panel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{$slot}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('messages.cancel')}}</button>
                <a href="#" data-tableId="{{$ref_datatable_id}}" class="modal-submit btn btn-primary">{{__('messages.save')}}</a>
            </div>
        </div>
    </div>
</div>
<!--end::Modal-->
