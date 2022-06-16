<div class="form-group row">
    <div class="col-md-6">
        <label class="col-12" for="name">{{ __("words.yourName") }}</label>
        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name')?old('name'):'' }}">
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-md-6">
        <label class="col-12" for="email">{{ __("words.email") }}</label>
        <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email')?old('email'):'' }}">
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
<div class="form-group">
    <label class="col-12" for="subject">{{ __("words.subject") }}</label>
    <input type="text" name="subject" id="subject" class="form-control @error('subject') is-invalid @enderror" value="{{ old('subject')?old('subject'):'' }}">
    @error('subject')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
</div>
<div class="form-group">
    <label class="col-12" for="message">{{ __("words.message") }}</label>
    <textarea class="form-control @error('message') is-invalid @enderror" name="message" id="message" rows="3">{{old('message')?old('message'):''}}</textarea>
    @error('message')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
</div>
