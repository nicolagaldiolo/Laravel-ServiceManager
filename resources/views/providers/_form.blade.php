<div class="m-portlet__body">
    <div class="m-form__section m-form__section--first">
        <div class="form-group m-form__group">
            <label class="">{{__('messages.name')}} *</label>

                <div class="m-input-icon m-input-icon--left">
                    <input type="text" class="form-control m-input required" name="name" value="{{old('name', $provider->name)}}">
                    <span class="m-input-icon__icon m-input-icon__icon--left">
                                                        <span>
                                                            <i class="la la-tag"></i>
                                                        </span>
                                                    </span>
                </div>
                <span class="m-form__help">{{__('messages.provider_name')}}</span>

                <span data-field="name" class="invalid-feedback" role="alert">
                    @if ($errors->has('name'))<strong>{{ $errors->first('name') }}</strong>@endif
                </span>





        </div>

        <div class="m-form__seperator m-form__seperator--dashed"></div>


        <div class="form-group m-form__group">
            <label class="">{{__('messages.website')}}</label>

                <div class="m-input-icon m-input-icon--left">
                    <input type="text" class="form-control m-input" name="website" value="{{old('website', $provider->website)}}">
                    <span class="m-input-icon__icon m-input-icon__icon--left">
                                                        <span>
                                                            <i class="la la-globe"></i>
                                                        </span>
                                                    </span>
                </div>
                <span class="m-form__help">{{__('messages.enter_url')}}</span>
                <span data-field="website" class="invalid-feedback" role="alert">
                    @if ($errors->has('website'))<strong>{{ $errors->first('website') }}</strong>@endif
                </span>




        </div>

        <div class="m-form__seperator m-form__seperator--dashed"></div>


        <div class="form-group m-form__group">
            <label class="">{{__('messages.label')}}</label>

            <div class="m-input-icon m-input-icon--left">
                <input type="text" class="form-control m-input cp_colorpicker" name="label" value="{{old('label', $provider->label)}}" />
                <span class="m-input-icon__icon m-input-icon__icon--left">
                                                    <span>
                                                        <i class="la la-tint"></i>
                                                    </span>
                                                </span>
            </div>
            <span class="m-form__help">{{__('messages.enter_label')}}</span>
            <span data-field="label" class="invalid-feedback" role="alert">
                @if ($errors->has('label'))<strong>{{ $errors->first('label') }}</strong>@endif
            </span>
        </div>

    </div>

</div>

<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
    <div class="m-form__actions m-form__actions--solid">
        <button type="submit" class="btn btn-primary">{{__('messages.save')}}</button>
        <a href="{{route('providers.index')}}" class="btn btn-secondary cancel">{{__('messages.cancel')}}</a>
    </div>
</div>
