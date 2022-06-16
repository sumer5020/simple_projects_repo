<div class="row form-group">
    <div class="col-md-6">
        <label for="short">{{ __("control.country").' - '.__("words.code") }}</label>
        <input name="short" placeholder="Ex: ye" type="text" class="form-control col-md-12 @error('short') is-invalid @enderror" value="{{ $country->short?$country->short:old('short') }}">
        @error('short')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
    <div class="row form-group">

    <div class="col-md-6">
        <label for="label">{{ __("control.country") }} En</label>
        <input name="label" placeholder="Ex: yemen" type="text" class="form-control col-md-12 @error('label') is-invalid @enderror" value="{{ $country->label?$country->label:old('label') }}">
        @error('label')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="label_ar">{{ __("control.country") }} Ar</label>
        <input name="label_ar" placeholder="مثال: اليمن" type="text" class="form-control col-md-12 @error('label_ar') is-invalid @enderror" value="{{ $country->label_ar?$country->label_ar:old('label_ar') }}">
        @error('label_ar')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

