<div class="m-portlet__body">
    <div class="m-form__section m-form__section--first">
        <div class="form-group m-form__group">
            <label class="">Name *</label>

                <div class="m-input-icon m-input-icon--left">
                    <input type="text" class="form-control m-input required" name="name" value="{{old('name', $provider->name)}}">
                    <span class="m-input-icon__icon m-input-icon__icon--left">
                                                        <span>
                                                            <i class="la la-tag"></i>
                                                        </span>
                                                    </span>
                </div>
                <span class="m-form__help">Please enter the provider name.</span>

                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                @endif




        </div>

        <div class="m-form__seperator m-form__seperator--dashed"></div>


        <div class="form-group m-form__group">
            <label class="">Website *</label>

                <div class="m-input-icon m-input-icon--left">
                    <input type="text" class="form-control m-input required" name="website" value="{{old('website', $provider->website)}}">
                    <span class="m-input-icon__icon m-input-icon__icon--left">
                                                        <span>
                                                            <i class="la la-globe"></i>
                                                        </span>
                                                    </span>
                </div>
                <span class="m-form__help">Please enter the provider URL.</span>
                @if ($errors->has('website'))
                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('website') }}</strong>
                                </span>
                @endif
            


        </div>

        <div class="m-form__seperator m-form__seperator--dashed"></div>


        <div class="form-group m-form__group">
            <label class="">Label *</label>

                <div class="m-input-icon m-input-icon--left">
                    <input type="text" class="form-control m-input required cp_colorpicker" name="label" value="{{old('label', $provider->label)}}" />
                    <span class="m-input-icon__icon m-input-icon__icon--left">
                                                        <span>
                                                            <i class="la la-tint"></i>
                                                        </span>
                                                    </span>
                </div>
                <span class="m-form__help">Please enter a label color.</span>
                @if ($errors->has('label'))
                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('label') }}</strong>
                                </span>
                @endif



        </div>

    </div>

</div>

<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
    <div class="m-form__actions m-form__actions--solid">
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{route('providers.index')}}" class="btn btn-secondary">Cancel</a>
    </div>
</div>