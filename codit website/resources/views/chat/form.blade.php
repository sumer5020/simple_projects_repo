<div class="row form-group">
    <div class="col-md-6">
        <label for="sender_id">{{ __("words.sender") }} En</label>
        <select class="form-control col-md-12 @error('sender_id') is-invalid @enderror" name="sender_id">
            <option value>-- {{ __("control.select") }} --</option>
            @foreach($users as $user)
            <option value="{{ $user->id }}"{{ $user->id==$chat_message->sender_id?"selected":old('sender_id')==$user->id?"selected":""}}>{{ $user->name }}</option>
            @endforeach
        </select>
        @error('sender_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="receiver_id">{{ __("words.receiver") }} En</label>
        <select class="form-control col-md-12 @error('receiver_id') is-invalid @enderror" name="receiver_id">
            <option value>-- {{ __("control.select") }} --</option>
            @foreach($users as $user)
            <option value="{{ $user->id }}"{{ $user->id==$chat_message->receiver_id?"selected":old('receiver_id')==$user->id?"selected":""}}>{{ $user->name }}</option>
            @endforeach
        </select>
        @error('receiver_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="row form-group">
    <div class="col-md-6">
        <label for="message">{{ __("words.message") }} Ar</label>
        <textarea name="message" cols="30" rows="3" class="form-control col-md-12 @error('message') is-invalid @enderror">{{ $chat_message->message?$chat_message->message: old('message') }}</textarea>
        @error('message')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="row form-group">
    <div class="col-md-6">
        <label for="status">{{ __("words.status") }}</label>
        <select class="form-control col-md-12 @error('status') is-invalid @enderror" name="status">
            <option value>-- {{ __("control.select") }} --</option>
            <option value="1" {{ $chat_message->status=='1'?"selected":old('status')=='1'?"selected":""}}>{{ __("control.active") }}</option>
            <option value="0" {{ $chat_message->status=='0'?"selected":old('status')=='0'?"selected":""}}>{{ __("control.unActive") }}</option>
        </select>
        @error('status')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
