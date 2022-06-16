<div class="row form-group">
    <div class="col-md-6">
        <label for="user_id">{{ __("words.userName") }}</label>
        <select class="form-control col-md-12 @error('user_id') is-invalid @enderror" name="user_id">
            <option value>-- {{ __("control.select") }} --</option>
            @foreach($users as $user)
            <option value="{{ $user->id }}"{{ $user->id==$offer_request->user_id?"selected":old('user_id')==$user->id?"selected":""}}>{{ $user->name }}</option>
            @endforeach
        </select>
        @error('user_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="offer_id">{{ trans_choice("words.offer",1) }} </label>
        <select class="form-control col-md-12 @error('offer_id') is-invalid @enderror" name="offer_id">
            <option value>-- {{ __("control.select") }} --</option>
            @foreach($offers as $offer)
            <option value="{{ $offer->id }}"{{ $offer->id==$offer_request->offer_id?"selected":old('offer_id')==$offer->id?"selected":""}}>{{ app()->getLocale()=='ar'?$offer->title:$offer->title_ar }}</option>
            @endforeach
        </select>
        @error('offer_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="row form-group">
    <div class="col-md-6">
        <label for="details">{{ __("words.content") }}</label>
        <textarea name="details" cols="30" rows="3" class="form-control col-md-12 @error('details') is-invalid @enderror">{{ $offer_request->details?$offer_request->details: old('details')?old('details'):'' }}</textarea>
        @error('details')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="created_at">{{ __("control.createdAt") }}</label>
        <div class="input-group">
            <input name="created_at" placeholder="YYY-MM-DD HH:MM:SS" max="19" type="text" class="form-control col-md-12 @error('created_at') is-invalid @enderror" value="{{ $offer_request->created_at?$offer_request->created_at: old('created_at') }}">
            <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </span>
        </div>
        @error('created_at')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

@if($offer_request->id)
<div class="row form-group">
    <div class="col-md-6">
        <label for="status">{{ __("words.status") }}</label>
        <select class="form-control col-md-12 @error('status') is-invalid @enderror" name="status">
            <option value>-- {{ __("control.select") }} --</option>
            <option value="1" {{ $offer_request->status=='1'?"selected":old('status')=='1'?"selected":""}}>{{ __("control.active") }}</option>
            <option value="0" {{ $offer_request->status=='0'?"selected":old('status')=='0'?"selected":""}}>{{ __("control.unActive") }}</option>
        </select>
        @error('status')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
@endif
