<div class="row form-group">
    <div class="col-md-6">
        <label for="title">{{ __("words.title") }} En</label>
        <input name="title" type="text" class="form-control col-md-12 @error('title') is-invalid @enderror" value="{{ $Card->title?$Card->title:old('title') }}">
@error('title')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="title_ar">{{ __("words.title") }} Ar</label>
        <input name="title_ar" type="text" class="form-control col-md-12 @error('title_ar') is-invalid @enderror" value="{{ $Card->title_ar?$Card->title_ar: old('title_ar') }}">
@error('title_ar')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="row form-group">
    <div class="col-md-6">
        <label for="desc">{{ __("words.content") }} En</label>
        <textarea name="desc" cols="30" rows="3" class="form-control col-md-12 @error('desc') is-invalid @enderror">{{ $Card->desc?$Card->desc: old('desc') }}</textarea>
@error('desc')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="desc_ar">{{ __("words.content") }} Ar</label>
        <textarea name="desc_ar" cols="30" rows="3" class="form-control col-md-12 @error('desc_ar') is-invalid @enderror">{{ $Card->desc_ar?$Card->desc_ar: old('desc_ar') }}</textarea>
@error('desc_ar')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="row form-group">
    <div class="col-md-6">
        <label for="icon">{{ __("words.title") }} En</label>
        <select class="form-control col-md-12 @error('icon') is-invalid @enderror" name="icon" id="icon">
            <option value>-- {{ __("control.select") }} --</option>
            @foreach($icons as $icon)
            <option value="{{ $icon->label }}"{{ $Card->icon==$icon->label?"selected":old('icon')==$icon->label?"selected":""}}>{{ substr($icon->label,6) }}</option>
            @endforeach
        </select>
@error('icon')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-md-6">
    <div class="img-thumbnail text-center ico_thumb"><i class="{{ $Card->icon?$Card->icon:old('icon') }}"></i></div>
    </div>
</div>
