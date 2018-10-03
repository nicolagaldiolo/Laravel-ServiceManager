<div class="m-portlet__body">
    <div class="m-form__section m-form__section--first">

        <div class="form-group m-form__group">
            <label class="">{{__('messages.deadline')}} *</label>

            <div class="custom_inline_datepicker">
                <input type="text" class="m_datepicker_hidden_input" name="deadline">
            </div>

            <span class="m-form__help">{{__('messages.enter_deadline')}}</span>
            @if ($errors->has('deadline'))
                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('deadline') }}</strong>
                                </span>
            @endif


        </div>


        <div class="form-group m-form__group">
            <label class="">{{__('messages.amount')}} *</label>

            <div class="m-input-icon m-input-icon--left">
                <input type='text' class="form-control required" name="amount"
                       value=""/>
                <span class="m-input-icon__icon m-input-icon__icon--left">
                                                        <span>
                                                            <i class="la la-euro"></i>
                                                        </span>
                                                    </span>

            </div>
            <span class="m-form__help">{{__('messages.currency_format')}} <code>€ 1.234,56</code></span>
            @if ($errors->has('amount'))
                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('amount') }}</strong>
                                </span>
            @endif


        </div>


    </div>
</div>
