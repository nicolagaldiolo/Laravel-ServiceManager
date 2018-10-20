<form action="{{route('renewal-frequencies.store', $renewalFrequency)}}" class="m-form m-form--fit" method="POST">
    @csrf
    <div class="m-portlet__body">
        <div class="m-form__section m-form__section--first">
            <div class="form-group m-form__group">
                <label class="">Valore *</label>
                <div class="m-input-icon m-input-icon--left">
                    <input type="text" name="value" class="form-control m-input" value="{{old('value', $renewalFrequency->value)}}">
                    <span class="m-input-icon__icon m-input-icon__icon--left">
                        <span>
                            <i class="la la-calendar"></i>
                        </span>
                    </span>
                </div>
                <span class="m-form__help">Inserisci un valore</span>
                <span data-field="value" class="invalid-feedback" role="alert"></span>
            </div>
            <div class="form-group m-form__group">
                <label class="">Tipo *</label>
                <select class="form-control" name="type">
                    <option value="">{{__('messages.choose_frequency_renewal')}}</option>
                    @foreach(\App\Enums\RenewalFrequencies::toSelectArray() as $key=>$value)
                        <option value="{{$key}}" @if($key == old('type', !is_null($renewalFrequency->type) ? $renewalFrequency->type : -1)) selected @endif>{{\App\Enums\RenewalFrequencies::getDescription($key)}}</option>
                    @endforeach
                </select>
                <span class="m-form__help">{{__('messages.enter_service_type_name')}}</span>
                <span data-field="type" class="invalid-feedback" role="alert"></span>
            </div>
        </div>
    </div>
</form>
