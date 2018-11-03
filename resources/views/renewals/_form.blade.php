<div class="m-portlet__body">
    <div class="m-form__section m-form__section--first">
        <div class="form-group m-form__group">
            <label class="">{{__('messages.deadline')}} *</label>
            <div class="custom_inline_datepicker">
                <input type="text" class="m_datepicker_hidden_input" name="deadline" value="{{old('deadline', $renewal->deadlineFormatted)}}">
            </div>
            <span class="m-form__help">{{__('messages.enter_deadline')}}</span>
            <span data-field="deadline" class="invalid-feedback" role="alert"></span>
        </div>
        <div class="form-group m-form__group">
            <label class="">{{__('messages.amount')}} *</label>
            <div class="m-input-icon m-input-icon--left">
                <input type='text' class="form-control required" name="amount" value="{{old('amount', amount_format($renewal->amount, false))}}"/>
                <span class="m-input-icon__icon m-input-icon__icon--left">
                        <span>
                            <i class="la la-euro"></i>
                        </span>
                    </span>
            </div>
            <span class="m-form__help">{{__('messages.currency_format')}} <code>€ 1.234,56</code></span>
            <span data-field="amount" class="invalid-feedback" role="alert"></span>
        </div>
    </div>
</div>
<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
    <div class="m-form__actions m-form__actions--solid">
        <button type="submit" class="btn btn-primary">{{__('messages.save')}}</button>
        <a href="#" class="btn btn-secondary cancel">{{__('messages.cancel')}}</a>
    </div>
</div>
