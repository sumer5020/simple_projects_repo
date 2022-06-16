<div class="row form-group">
    <div class="col-md-6">
        <label for="title">{{ __("words.title") }} En</label>
        <input name="title" type="text" class="form-control col-md-12 @error('title') is-invalid @enderror" value="{{ $portfolio->title?$portfolio->title:old('title') }}">
        @error('title')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="title_ar">{{ __("words.title") }} Ar</label>
        <input name="title_ar" type="text" class="form-control col-md-12 @error('title_ar') is-invalid @enderror" value="{{ $portfolio->title_ar?$portfolio->title_ar: old('title_ar') }}">
        @error('title_ar')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="row form-group">
    <div class="col-md-6">
        <label for="post">{{ __("words.content") }} En</label>
        <textarea name="post" cols="30" rows="3" class="form-control col-md-12 @error('post') is-invalid @enderror">{{ $portfolio->post?$portfolio->post: old('post') }}</textarea>
        @error('post')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="post_ar">{{ __("words.content") }} Ar</label>
        <textarea name="post_ar" cols="30" rows="3" class="form-control col-md-12 @error('post_ar') is-invalid @enderror">{{ $portfolio->post_ar?$portfolio->post_ar: old('post_ar') }}</textarea>
        @error('post_ar')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="row form-group">
    <div class="col-md-6">
        <label for="cati_id">{{ __("words.catigury") }}</label>
        <select class="form-control col-md-12 @error('cati_id') is-invalid @enderror" name="cati_id">
            <option value>-- {{ __("control.select") }} --</option>
            @foreach($catis as $cati)
            <option value="{{ $cati->id }}" {{ $portfolio->cati_id==$cati->id?"selected":old('cati_id')==$cati->id?"selected":""}}>{{$cati->label}}</option>
            @endforeach
        </select>
        @error('cati_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="media_pic">{{ __("words.image") }}</label>
        <input name="media_pic" type="file" class="form-control col-md-12 @error('media_pic') is-invalid @enderror">
        @error('media_pic')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="row form-group">
    <div class="col-md-6">

        <label for="color">{{ __("words.color") }}</label>
        <input name="color" style="background:{{ $portfolio->color?$portfolio->color:"#ffffff" }};" type="color" class="form-control col-11 @error('color') is-invalid @enderror" value="{{ $portfolio->color?$portfolio->color: "#ffffff" }}">
        @error('color')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="media_vid">{{ __("words.vid") }}</label>
        <input name="media_vid" type="url" class="form-control col-md-12 @error('media_vid') is-invalid @enderror" value="{{ $portfolio->media_vid?$portfolio->media_vid: old('media_vid') }}">
        @error('media_vid')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        <!--{{ $errors->first('media_vid') }}-->
        @enderror
    </div>
</div>
@if($portfolio->id)
<div class="row form-group">
    <div class="col-md-6">
        <label for="status">{{ __("words.status") }}</label>
        <select class="form-control col-md-12 @error('status') is-invalid @enderror" name="status">
            <option value>-- {{ __("control.select") }} --</option>
            <option value="1" {{ $portfolio->status=='1'?"selected":old('status')=='1'?"selected":""}}>{{ __("control.active") }}</option>
            <option value="0" {{ $portfolio->status=='0'?"selected":old('status')=='0'?"selected":""}}>{{ __("control.unActive") }}</option>
        </select>
        @error('status')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
@endif
