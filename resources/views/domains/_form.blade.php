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
        <label class="col-form-label col-lg-3 col-sm-12">URL *</label>
        <div class="col-lg-8 col-md-12">
            <div class="m-input-icon m-input-icon--left">
                <input type="text" class="form-control m-input required" name="url" placeholder="Enter your url" value="{{old('url', $domain->url)}}">
                <span class="m-input-icon__icon m-input-icon__icon--left">
													<span>
														<i class="la la-globe"></i>
													</span>
												</span>
            </div>
            <span class="m-form__help">Please enter your website URL.</span>
            @if ($errors->has('url'))
                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('url') }}</strong>
                            </span>
            @endif
        </div>

        @if(!empty($domain->screenshoot))
            <img src="{{$domain->screenshoot}}">
        @endif


    </div>

    <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space"></div>

    <div class="form-group m-form__group row">
        <label class="col-form-label col-lg-3 col-sm-12">Domain</label>
        <div class="col-lg-8 col-md-12">
            <select class="form-control m-select2 m_select2_4" name="domain">
                @foreach($providers as $provider)
                    <option value="{{$provider->id}}"
                            @if($provider->id == old('domain', $domain->domain)) selected @endif>{{$provider->name}}</option>
                @endforeach
            </select>
            <span class="m-form__help">Please select a domain provider.</span>
            @if ($errors->has('domain'))
                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('domain') }}</strong>
                            </span>
            @endif
        </div>


    </div>

    <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space"></div>

    <div class="form-group m-form__group row">
        <label class="col-form-label col-lg-3 col-sm-12">Hosting</label>
        <div class="col-lg-8 col-md-12">
            <select class="form-control m-select2 m_select2_4" name="hosting">
                @foreach($providers as $provider)
                    <option value="{{$provider->id}}"
                            @if($provider->id == old('hosting', $domain->hosting)) selected @endif>{{$provider->name}}</option>
                @endforeach
            </select>
            <span class="m-form__help">Please select a hosting provider.</span>
            @if ($errors->has('hosting'))
                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('hosting') }}</strong>
                            </span>
            @endif
        </div>


    </div>

    <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space"></div>


    <div class="form-group m-form__group row">
        <label class="col-form-label col-lg-3 col-sm-12">Deadline *</label>
        <div class="col-lg-8 col-md-12">
            <div class="m-input-icon m-input-icon--left">
            <!--<input type="text" class="form-control required" id="m_datetimepicker_1" name="deadline" readonly value="{{old('deadline', $domain->deadline)}}" placeholder="Select date" />-->
                <input type="text" class="form-control required" name="deadline"
                       value="{{old('deadline', $domain->deadline)}}" placeholder="Select date"/>
                <span class="m-input-icon__icon m-input-icon__icon--left">
													<span>
														<i class="la la-calendar"></i>
													</span>
												</span>

            </div>
            <span class="m-form__help">Please enter a deadline.</span>
            @if ($errors->has('deadline'))
                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('deadline') }}</strong>
                            </span>
            @endif
        </div>

    </div>

    <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space"></div>

    <div class="form-group m-form__group row">
        <label class="col-form-label col-lg-3 col-sm-12">Amount *</label>
        <div class="col-lg-6 col-md-9 col-sm-12">
        <!--<input type='text' class="form-control required" id="m_inputmask_7" type="text" name="amount" value="{{old('amount', $domain->amount)}}"/>-->
            <input type='text' class="form-control required" name="amount" value="{{old('amount', $domain->amount)}}"/>
            <span class="m-form__help">Currency format <code>€ ___.__1.234,56</code></span>
            @if ($errors->has('amount'))
                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('amount') }}</strong>
                            </span>
            @endif
        </div>


    </div>

    <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space"></div>

    <div class="m-form__group form-group row">
        <label class="col-form-label col-lg-3 col-sm-12">Pagato</label>
        <div class="col-lg-8 col-md-12">
            <div>

                                <span class="m-switch m-switch--lg m-switch--icon m-switch--success">
                                    <label>
                                        <input type="hidden" checked="checked" value="0" name="payed">
                                        <input class="required" type="checkbox" @if(old('payed', $domain->payed) == 1)checked="checked" @endif value="1" name="payed">
                                        <span></span>
                                    </label>
                                </span>
            </div>
            <span class="m-form__help">Please set the state of payment.</span>
            @if ($errors->has('payed'))
                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('payed') }}</strong>
                            </span>
            @endif
        </div>


    </div>

    <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space"></div>

    <div class="form-group m-form__group row">
        <label class="col-form-label col-lg-3 col-sm-12">Note</label>
        <div class="col-lg-8 col-md-12">
            <textarea class="form-control m-input" name="note" placeholder="Enter a note"
                      rows="10">{{old('note', $domain->note)}}</textarea>
            <span class="m-form__help">Please enter a note.</span>
            @if ($errors->has('note'))
                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('note') }}</strong>
                            </span>
            @endif
        </div>


    </div>


</div>

<div class="m-portlet__foot m-portlet__foot--fit">
    <div class="m-form__actions m-form__actions">
        <div class="row">
            <div class="col-lg-9 ml-lg-auto">
                <button type="submit" class="btn btn-success">Save</button>
                <a href="{{route('domains.index')}}" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </div>
</div>