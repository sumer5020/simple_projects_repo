<div class="row form-group">
    <div class="col-md-6">
        <label for="q">{{ __("words.question") }} En</label>
        <input name="q" type="text" class="form-control col-md-12 @error('q') is-invalid @enderror" value="{{ $chat->q?$chat->q:old('q') }}">
        @error('q')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="q_ar">{{ __("words.question") }} Ar</label>
        <input name="q_ar" type="text" class="form-control col-md-12 @error('q_ar') is-invalid @enderror" value="{{ $chat->q_ar?$chat->q_ar:old('q_ar') }}">
        @error('q_ar')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="row form-group">
    <div class="col-md-6">
        <label for="answer">{{ __("words.answer") }} En</label>
        <input name="answer" type="text" class="form-control col-md-12 @error('answer') is-invalid @enderror" value="{{ $chat->answer?$chat->answer:old('answer') }}">
        @error('answer')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="answer_ar">{{ __("words.answer") }} Ar</label>
        <input name="answer_ar" type="text" class="form-control col-md-12 @error('answer_ar') is-invalid @enderror" value="{{ $chat->answer_ar?$chat->answer_ar:old('answer_ar') }}">
        @error('answer_ar')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

@if($chat->id)
<div class="row form-group">
    <div class="col-md-6">
        <label for="status">{{ __("words.status") }}</label>
        <select class="form-control col-md-12 @error('status') is-invalid @enderror" name="status">
            <option value>-- {{ __("control.select") }} --</option>
            <option value="1" {{ $chat->status=='1'?"selected":old('status')=='1'?"selected":""}}>{{ __("control.active") }}</option>
            <option value="0" {{ $chat->status=='0'?"selected":old('status')=='0'?"selected":""}}>{{ __("control.unActive") }}</option>
        </select>
        @error('status')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
@endif
