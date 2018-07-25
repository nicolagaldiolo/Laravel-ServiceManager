<div class="m-portlet__body">
    <div class="m-form__content">
        <div class="m-alert m-alert--icon alert alert-danger m--hide" role="alert" id="m_form_1_msg">
            <div class="m-alert__icon">
                <i class="la la-warning"></i>
            </div>
            <div class="m-alert__text">
                Oh snap! Change a few things up and try submitting again.
            </div>
            <div class="m-alert__close">
                <button type="button" class="close" data-close="alert" aria-label="Close">
                </button>
            </div>
        </div>
    </div>

    <div class="form-group m-form__group row">
        <label class="col-form-label col-lg-3 col-sm-12">Name *</label>
        <div class="col-lg-8 col-md-12">
            <div class="m-input-icon m-input-icon--left">
                <input type="text" class="form-control m-input required" name="name" placeholder="Enter the provider name" value="{{old('name', $provider->name)}}">
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



    </div>

    <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space"></div>


    <div class="form-group m-form__group row">
        <label class="col-form-label col-lg-3 col-sm-12">Website *</label>
        <div class="col-lg-8 col-md-12">
            <div class="m-input-icon m-input-icon--left">
                <input type="text" class="form-control m-input required" name="website" placeholder="Enter the provider URL" value="{{old('website', $provider->website)}}">
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


    </div>

    <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space"></div>


    <div class="form-group m-form__group row">
        <label class="col-form-label col-lg-3 col-sm-12">Label *</label>
        <div class="col-lg-8 col-md-12">
            <div class="m-input-icon m-input-icon--left">
                <input id="mycp" type="text" class="form-control m-input required" name="label" placeholder="#3d557b" value="{{old('label', $provider->label)}}">
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
