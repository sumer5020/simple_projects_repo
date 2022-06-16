<div class="row form-group">
    <div class="col-md-6">
        <label for="country_id">{{ __("control.country") }}</label>
        <select name="country_id" class="form-control col-md-12 @error('country_id') is-invalid @enderror">
            <option value="">{{ __('control.select') }}</option>
            @foreach($countrys as $country)
                <option {{ $gov->country_id == $country->id?"selected": old('country_id') == $country->id?"selected":""}} value="{{ $country->id }}">{{ app()->getLocale()=="en"?$country->label:$country->label_ar }}</option>
            @endforeach
        </select>
        @error('country_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="row form-group">
    <div class="col-md-6">
        <label for="label">{{ __("control.gov") }} En</label>
        <input name="label" type="text" class="form-control col-md-12 @error('label') is-invalid @enderror" value="{{ $gov->label?$gov->label:old('label') }}">
         @error('label')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="label_ar">{{ __("control.gov") }} Ar</label>
        <input name="label_ar" type="text" class="form-control col-md-12 @error('label_ar') is-invalid @enderror" value="{{ $gov->label_ar?$gov->label_ar: old('label_ar') }}">
        @error('label_ar')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
