<div class="row form-group">
    <div class="col-md-6">
        <label for="cati_id">{{ __("words.catigury") }}</label>
        <select class="form-control col-md-12 @error('cati_id') is-invalid @enderror" name="cati_id">
            <option value>-- {{ __("control.select") }} --</option>
            @foreach($catis as $cati)
            <option value="{{ $cati->id }}" {{ $cati->id==$offer->cati_id ? "selected": old('cati_id') == $cati->id ? "selected" : ""}}>{{ $cati->label }}</option>
            @endforeach
        </select>
        @error('cati_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="row form-group">
    <div class="col-md-6">
        <label for="title">{{ __("words.title") }} En</label>
        <input name="title" type="text" class="form-control col-md-12 @error('title') is-invalid @enderror" value="{{ $offer->title?$offer->title:old('title') }}">
        @error('title')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="title_ar">{{ __("words.title") }} Ar</label>
        <input name="title_ar" type="text" class="form-control col-md-12 @error('title_ar') is-invalid @enderror" value="{{ $offer->title_ar?$offer->title_ar: old('title_ar') }}">
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
        <textarea name="desc" cols="30" rows="3" class="form-control col-md-12 @error('desc') is-invalid @enderror">{{ $offer->desc?$offer->desc: old('desc') }}</textarea>
        @error('desc')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="desc_ar">{{ __("words.content") }} Ar</label>
        <textarea name="desc_ar" cols="30" rows="3" class="form-control col-md-12 @error('desc_ar') is-invalid @enderror">{{ $offer->desc_ar?$offer->desc_ar: old('desc_ar') }}</textarea>
        @error('desc_ar')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="row form-group">
    <div class="col-md-4">
        <label for="cost">{{ __("words.cost") }}</label>
        <input name="cost" type="text" max="5" class="form-control col-md-12 @error('cost') is-invalid @enderror" value="{{ $offer->cost?$offer->cost:old('cost') }}">
        @error('cost')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-md-4">
        <label for="start_at">{{ __("control.startDate") }}</label>
        <div class="input-group">
            <input name="start_at" placeholder="YYY-MM-DD HH:MM:SS" max="19" type="text" class="form-control col-md-12 @error('start_at') is-invalid @enderror" value="{{ $offer->start_at?$offer->start_at: old('start_at') }}">
            <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </span>
        </div>
        @error('start_at')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-md-4">
        <label for="end_at">{{ __("control.endDate") }}</label>
        <div class="input-group">
            <input name="end_at" placeholder="YYY-MM-DD HH:MM:SS" max="19" type="text" class="form-control col-md-12 @error('end_at') is-invalid @enderror" value="{{ $offer->end_at?$offer->end_at: old('end_at') }}">
            <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </span>
        </div>
        @error('end_at')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

@if($offer->id)
<div class="row form-group">
    <div class="col-md-6">
        <label for="status">{{ __("words.status") }}</label>
        <select class="form-control col-md-12 @error('status') is-invalid @enderror" name="status">
            <option value>-- {{ __("control.select") }} --</option>
            <option value="1" {{ $offer->status=='1'?"selected":old('status')=='1'?"selected":""}}>{{ __("control.active") }}</option>
            <option value="0" {{ $offer->status=='0'?"selected":old('status')=='0'?"selected":""}}>{{ __("control.unActive") }}</option>
        </select>
        @error('status')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-md-6">
    <label for="pay_count">{{ __("words.payCount") }}</label>
    <input name="pay_count" type="text" class="form-control col-md-12 @error('pay_count') is-invalid @enderror" value="{{ $offer->pay_count||$offer->pay_count==0?$offer->pay_count: old('pay_count') }}">
    @error('pay_count')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
</div>
@endif
