<div class="m-portlet__body">
    <div class="m-form__section m-form__section--first">

        <div class="form-group m-form__group row">
            <div class="col-lg-6">
                <label class="">{{__('messages.customer')}} *</label>

                <select class="form-control m-select2 m_select2_4" name="customer_id">
                    <option value="">{{__('messages.choose_customer')}}</option>
                    @foreach($customers as $customer)
                        <option value="{{$customer->id}}" @if($customer->id == old('customer_id', $service->customer_id)) selected @endif>{{$customer->name}}</option>
                    @endforeach
                </select>
                <span class="m-form__help">{{__('messages.choose_customer')}}.</span>

                @if ($errors->has('customer_id'))
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('customer_id') }}</strong>
                            </span>
                @endif
            </div>
            <div class="col-lg-6">
                <label class="">{{__('messages.service_type')}} *</label>

                <select class="form-control m-select2 m_select2_4" name="service_type_id">
                    <option value="">{{__('messages.choose_service_type')}}</option>
                    @foreach($service_types as $type)
                        <option value="{{$type->id}}"
                                @if($type->id == old('service_type_id', $service->service_type_id)) selected @endif>{{$type->name}}</option>
                    @endforeach
                </select>
                <span class="m-form__help">{{__('messages.choose_service_type')}}.</span>
                @if ($errors->has('service_type_id'))
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('service_type_id') }}</strong>
                            </span>
                @endif
            </div>


        </div>

        <div class="m-form__seperator m-form__seperator--dashed"></div>

        <div class="form-group m-form__group">
            <label class="">{{__('messages.url')}} *</label>

            <div class="m-input-icon m-input-icon--left">
                <input type="text" class="form-control m-input required" name="url" value="{{old('url', $service->url)}}">
                <span class="m-input-icon__icon m-input-icon__icon--left">
                                                        <span>
                                                            <i class="la la-globe"></i>
                                                        </span>
                                                    </span>
            </div>
            <span class="m-form__help">{{__('messages.enter_url')}}</span>
            @if ($errors->has('url'))
                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('url') }}</strong>
                                </span>
            @endif

        </div>


        <div class="m-form__seperator m-form__seperator--dashed"></div>

        <div class="form-group m-form__group row">
            <div class="col-lg-6">
                <label class="">{{__('messages.provider')}} *</label>

                <select class="form-control m-select2 m_select2_4" name="provider_id">
                    <option value="">{{__('messages.choose_provider')}}</option>
                    @foreach($providers as $provider)
                        <option value="{{$provider->id}}"
                                @if($provider->id == old('provider_id', $service->provider_id)) selected @endif>{{$provider->name}}</option>
                    @endforeach
                </select>
                <span class="m-form__help">{{__('messages.choose_provider')}}.</span>
                @if ($errors->has('provider_id'))
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('provider_id') }}</strong>
                            </span>
                @endif
            </div>
            <div class="col-lg-6">

                <label class="">{{__('messages.frequency_renewal')}} *</label>

                <select class="form-control m-select2 m_select2_4" name="frequency">
                    <option value="">{{__('messages.choose_frequency_renewal')}}</option>
                    @foreach(\App\Enums\FrequencyRenewals::toSelectArray() as $key=>$value)
                        <option value="{{$key}}"
                                @if($key == old('frequency', $service->frequency)) selected @endif>{{\App\Enums\FrequencyRenewals::getDescription($key)}}</option>
                    @endforeach
                </select>
                <span class="m-form__help">{{__('messages.choose_frequency_renewal')}}.</span>
                @if ($errors->has('frequency'))
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('frequency') }}</strong>
                        </span>
                @endif

            </div>


        </div>


        <div class="m-form__seperator m-form__seperator--dashed"></div>

        <div class="form-group m-form__group">
            <label class="">{{__('messages.note')}}</label>

            <textarea class="form-control m-input" name="note" rows="10">{{old('note', $service->note)}}</textarea>
            <span class="m-form__help">{{__('messages.enter_note')}}</span>
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
        <button type="submit" class="btn btn-primary">{{__('messages.save')}}</button>
        <a href="{{route('services.index')}}" class="btn btn-secondary">{{__('messages.cancel')}}</a>
    </div>
</div>
