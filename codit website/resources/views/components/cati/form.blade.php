<div class="row form-group">
<div class="col-md-6">
        <label for="label">{{ __("words.catigury") }}</label>
        <input name="label" type="text" class="form-control col-md-12 @error('label') is-invalid @enderror" value="{{ $cati->label?$cati->label:old('label') }}">
        @error('label')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
