<div class="m-portlet__body">
    <div class="m-form__section m-form__section--first">
        <div class="form-group m-form__group">
            <label class="">URL *</label>

            <div class="m-input-icon m-input-icon--left">
                <input type="text" class="form-control m-input required" name="url" placeholder="Enter your url"
                       value="{{old('url', $domain->url)}}">
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

        <div class="m-form__seperator m-form__seperator--dashed"></div>

        <div class="form-group m-form__group">
            <label class="">Customer *</label>

            <select class="form-control m-select2 m_select2_4" name="customer_id">
                @foreach($customers as $customer)
                    <option value="{{$customer->id}}"
                            @if($customer->id == old('customer_id', $domain->customer_id)) selected @endif>{{$customer->name}}</option>
                @endforeach
            </select>
            <span class="m-form__help">Please select a customer.</span>
            @if ($errors->has('customer_id'))
                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('customer_id') }}</strong>
                            </span>
            @endif


        </div>

        <div class="m-form__seperator m-form__seperator--dashed"></div>

        <div class="form-group m-form__group">
            <label class="">Domain</label>

            <select class="form-control m-select2 m_select2_4" name="domain_id">
                @foreach($providers as $provider)
                    <option value="{{$provider->id}}"
                            @if($provider->id == old('domain_id', $domain->domain_id)) selected @endif>{{$provider->name}}</option>
                @endforeach
            </select>
            <span class="m-form__help">Please select a domain provider.</span>
            @if ($errors->has('domain_id'))
                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('domain_id') }}</strong>
                            </span>
            @endif

        </div>

        <div class="m-form__seperator m-form__seperator--dashed"></div>

        <div class="form-group m-form__group">
            <label class="">Hosting</label>

            <select class="form-control m-select2 m_select2_4" name="hosting_id">
                @foreach($providers as $provider)
                    <option value="{{$provider->id}}"
                            @if($provider->id == old('hosting_id', $domain->hosting_id)) selected @endif>{{$provider->name}}</option>
                @endforeach
            </select>
            <span class="m-form__help">Please select a hosting provider.</span>
            @if ($errors->has('hosting_id'))
                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('hosting_id') }}</strong>
                            </span>
            @endif


        </div>

        @if($deadline)
            <div class="m-form__seperator m-form__seperator--dashed"></div>


            <div class="form-group m-form__group">
                <label class="">Deadline *</label>

                <div class="m-input-icon m-input-icon--left">

                    <input type="text" class="form-control required" id="m_datepicker_1" name="deadline" readonly value="{{old('deadline', $domain->deadlineFormatted)}}" placeholder="Select date" />
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
        @endif

        <div class="m-form__seperator m-form__seperator--dashed"></div>

        <div class="form-group m-form__group">
            <label class="">Amount *</label>

            <div class="m-input-icon m-input-icon--left">
                <input type='text' class="form-control required" name="amount"
                       value="{{old('amount', $domain->amountFormatted)}}"/>
                <span class="m-input-icon__icon m-input-icon__icon--left">
                                                        <span>
                                                            <i class="la la-euro"></i>
                                                        </span>
                                                    </span>

            </div>
            <span class="m-form__help">Currency format <code>€ 1.234,56</code></span>
            @if ($errors->has('amount'))
                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('amount') }}</strong>
                                </span>
            @endif


        </div>

        @if($expiring)
            <div class="m-form__seperator m-form__seperator--dashed"></div>

            <div class="m-form__group form-group">
                <label class="">Pagato</label>

                <div>

                                        <span class="m-switch m-switch--lg m-switch--icon m-switch--success">
                                            <label>
                                                <input type="hidden" checked="checked" value="0" name="payed">
                                                <input class="required" type="checkbox"
                                                       @if(old('payed', $domain->payed) == 1)checked="checked"
                                                       @endif value="1"
                                                       name="payed">
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
        @endif

        <div class="m-form__seperator m-form__seperator--dashed"></div>

        <div class="form-group m-form__group">
            <label class="">Note</label>

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

<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
    <div class="m-form__actions m-form__actions--solid">
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{route('domains.index')}}" class="btn btn-secondary">Cancel</a>
    </div>
</div>