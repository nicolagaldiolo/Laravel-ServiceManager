<div class="m-portlet__body">
    <div class="m-form__section m-form__section--first">
        <div class="form-group m-form__group">
            <label class="">{{__('messages.renewal_frequencies_value')}} *</label>
            <div class="m-input-icon m-input-icon--left">
                <input type="text" name="value" class="form-control m-input" value="{{old('value', $renewalFrequency->value)}}">
                <span class="m-input-icon__icon m-input-icon__icon--left">
                        <span>
                            <i class="la la-calendar"></i>
                        </span>
                    </span>
            </div>
            <span class="m-form__help">{{__('messages.choose_renewal_frequencies_value')}}</span>
            <span data-field="value" class="invalid-feedback" role="alert"></span>
        </div>
        <div class="form-group m-form__group">
            <label class="">{{__('messages.renewal_frequencies_type')}} *</label>
            <select class="form-control" name="type">
                <option value="">{{__('messages.choose_renewal_frequencies_type')}}</option>
                @foreach(\App\Enums\RenewalFrequencies::toSelectArray() as $key=>$value)
                    <option value="{{$key}}" @if($key == old('type', !is_null($renewalFrequency->type) ? $renewalFrequency->type : -1)) selected @endif>{{\App\Enums\RenewalFrequencies::getDescription($key)}}</option>
                @endforeach
            </select>
            <span class="m-form__help">{{__('messages.choose_renewal_frequencies_type')}}</span>
            <span data-field="type" class="invalid-feedback" role="alert"></span>
        </div>
    </div>
</div>
<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
    <div class="m-form__actions m-form__actions--solid">
        <button type="submit" class="btn btn-primary">{{__('messages.save')}}</button>
        <a href="" class="btn btn-secondary cancel">{{__('messages.cancel')}}</a>
    </div>
</div>
