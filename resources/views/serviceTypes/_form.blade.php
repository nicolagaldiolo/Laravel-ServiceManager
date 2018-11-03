<div class="m-portlet__body">
    <div class="m-form__section m-form__section--first">
        <div class="form-group m-form__group">
            <label class="">{{__('messages.name')}} *</label>
            <div class="m-input-icon m-input-icon--left">
                <input type="text" name="name" class="form-control m-input" value="{{old('name', $serviceType->name)}}">
                <span class="m-input-icon__icon m-input-icon__icon--left">
                        <span>
                            <i class="la la-tag"></i>
                        </span>
                    </span>
            </div>
            <span class="m-form__help">{{__('messages.enter_service_type_name')}}</span>
            <span data-field="name" class="invalid-feedback" role="alert"></span>
        </div>
    </div>
</div>
<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
    <div class="m-form__actions m-form__actions--solid">
        <button type="submit" class="btn btn-primary">{{__('messages.save')}}</button>
        <a href="" class="btn btn-secondary cancel">{{__('messages.cancel')}}</a>
    </div>
</div>
