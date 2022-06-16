<h4>{{ __('control.basicInfo') }} :</h4>
<div class="row form-group">
    <div class="col-md-6">
        <label for="name">{{ __("words.name") }}</label>
        <input name="name" type="text" class="form-control col-md-12 @error('name') is-invalid @enderror" value="{{ $user->name?$user->name:old('name') }}">
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="username">{{ __("words.userName") }}</label>
        <input name="username" type="text" class="form-control col-md-12 @error('username') is-invalid @enderror" value="{{ $user->username?$user->username:old('username') }}">
        @error('username')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="row form-group">
    <div class="col-md-6">
        <label for="email">{{ __("words.email") }}</label>
        <input name="email" type="email" class="form-control col-md-12 @error('email') is-invalid @enderror" value="{{ $user->email?$user->email:old('email') }}">
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="conEmail">{{ __("words.conEmail") }}</label>
        <input name="conEmail" type="email" class="form-control col-md-12 @error('conEmail') is-invalid @enderror" value="{{ $user->profile->email?$user->profile->email:old('conEmail') }}">
        @error('conEmail')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="row form-group">
    <div class="col-md-6">
        <label for="phone1">{{ __("words.phoneNumber") }} 1</label>
        <input name="phone1" type="text" class="form-control col-md-12 @error('phone1') is-invalid @enderror" value="{{ $user->phone1?$user->phone1:old('phone1') }}">
        @error('phone1')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="phone2">{{ __("words.phoneNumber") }} 2</label>
        <input name="phone2" type="text" class="form-control col-md-12 @error('phone2') is-invalid @enderror" value="{{ $user->phone2?$user->phone2:old('phone2') }}">
        @error('phone2')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
<hr>
<h4>{{ __('control.advanceInfo') }} :</h4>
<div class="row form-group">
    <div class="col-md-6">
        <label for="img">{{ __("words.image") }}</label>
        <input name="img" type="file" class="form-control col-md-12 @error('img') is-invalid @enderror">
        @error('img')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-md-6">
        <img style="hieght:300px;width:300px;" src="{{ $user->profile->img?asset("/storage/".$user->profile->img):asset('img/personal.PNG') }}">
    </div>
</div>
<div class="row form-group">
    <div class="col-md-6">
        <label for="nick_name">{{ __("control.nickName") }}</label>
        <input name="nick_name" type="text" class="form-control col-md-12 @error('nick_name') is-invalid @enderror" value="{{ $user->profile->nick_name?$user->profile->nick_name:old('nick_name') }}">
        @error('nick_name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="gender">{{ __("control.gender") }}</label>
        <select class="form-control col-md-12 @error('gender') is-invalid @enderror" name="gender">
            <option value>-- {{ __("control.select") }} --</option>
            <option value="1" {{ $user->profile->gender=='1'?"selected":old('gender')=='1'?"selected":""}}>{{ __("control.male") }}</option>
            <option value="2" {{ $user->profile->gender=='2'?"selected":old('gender')=='2'?"selected":""}}>{{ __("control.female") }}</option>
        </select>
        @error('gender')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
<div class="row form-group">
    <div class="col-md-4">
        <label class="w-100" for="country">{{ __("control.country") }}</label>
        <select name="country" class="form-control">
            <option data-flag="zz" value="">{{ __("control.select") }}</option>
            @foreach($countrys as $country)
                <option {{ $user->profile->country==$country->id?"selected":"" }} value="{{ $country->id }}" data-flag="{{ $country->short }}">
                {{ app()->getLocale()=="en"?$country->label:$country->label_ar }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="w-100" for="gov">{{ __("control.gov") }}</label>
        <select name="gov" class="form-control">
            <option value="">{{ __("control.select") }}</option>
            @foreach($govs as $gov)
            <option {{ $user->profile->gov==$gov->id?"selected":"" }} value="{{ $gov->id }}">{{ app()->getLocale()=="en"?$gov->label:$gov->label_ar }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="w-100" for="district">{{ __("control.district") }}</label>
        <input max="20" value="{{ $user->profile->district?$user->profile->district:"" }}" name="district" class="form-control">
    </div>
</div>

<div class="row form-group">
    <div class="col-md-12">
        <label for="about">{{ __("control.about") }}</label>
        <textarea name="about" cols="30" rows="3" class="form-control col-md-12 @error('about') is-invalid @enderror">{{ $user->profile->about?$user->profile->about: old('about') }}</textarea>
        @error('about')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
<hr>
@if(Auth::user()->rule=='sprov')
    <div class="row form-group">
        <div class="col-md-6">
            <label for="email_verified_at">{{ __("words.emailVerifiedDate") }}</label>
            <div class="input-group">
                <input name="email_verified_at" placeholder="YYY-MM-DD HH:MM:SS" max="19" type="text" class="form-control col-md-12 @error('email_verified_at') is-invalid @enderror" value="{{ $user->email_verified_at?$user->email_verified_at: old('email_verified_at') }}">
                <span class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </span>
            </div>
            @error('email_verified_at')
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
                <option value="1" {{ $user->status=='1'?"selected":old('status')=='1'?"selected":""}}>{{ __("control.active") }}</option>
                <option value="0" {{ $user->status=='0'?"selected":old('status')=='0'?"selected":""}}>{{ __("control.unActive") }}</option>
            </select>
            @error('status')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="rule">{{ __("words.rule") }}</label>
            <select class="form-control col-md-12 @error('rule') is-invalid @enderror" name="rule">
                <option value>-- {{ __("control.select") }} --</option>
                <option value="customer" {{ $user->rule=='customer'?"selected":old('rule')=='customer'?"selected":""}}>{{ trans_choice('words.user',1) }}</option>
                <option value="prov" {{ $user->rule=='prov'?"selected":old('rule')=='prov'?"selected":""}}>{{ trans_choice('words.admin',1) }}</option>
                <option value="sprov" {{ $user->rule=='sprov'?"selected":old('rule')=='sprov'?"selected":""}}>{{ trans_choice('words.admin',1) }}
                    <\_
                </option>
            </select>
            @error('rule')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
@endif

