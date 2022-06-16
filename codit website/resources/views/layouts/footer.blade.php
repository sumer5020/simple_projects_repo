<footer>
    <div class="shape"></div>
    <div class="container">
        <nav class="pt-5 navbar-dark">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="logo">
                            <figure>C</figure>
                            <figure>O</figure>
                            <figure>D</figure>
                            <figure>E</figure>
                        </div>
                        <p class="navbar-brand px-5">{{ config('app.name', 'Codeit') }}</p>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3 py-3">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <h5>smart to continue</h5>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#">smart item 1</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">smart item 1</a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3 py-3">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <h5>Title 2</h5>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#">smart item 1</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">smart item 1</a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3 py-3">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <h5>Title 3</h5>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#">smart item 1</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">smart item 1</a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3 py-3">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <h5>{{ __("words.followUs") }}</h5>
                            </li>
                            <li class="nav-item">
                                <form action="#" id="Follow">
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <button onclick="return false;" class="input-group-text h-100" type="submit"><i class="fa fa-envelope" aria-hidden="true"></i></button>
                                            </div>
                                            <input type="email" class="form-control" name="email" placeholder="example@ext.com" required="">
                                        </div>
                                    </div>
                                </form>
                            </li>
                            <li class="nav-item">
                                <div class="d-flex justify-content-between">
                                    <div class="border-bottom rounded shadow-lg">
                                        <a class="media nav-link" href="https://www.facebook.com/s.alkadasi" target="_blank" role="button"><i class="fa fa-facebook"></i></a>
                                        <a class="media nav-link" href="https://github.com/sumer5020" target="_blank" role="button"><i class="fa fa-github"></i></a>
                                        <a class="media nav-link" href="https://stackoverflow.com/sumer5020" target="_blank" role="button"><i class="fa fa-stack-overflow"></i></a>
                                        <a class="media nav-link" href="https://pinterest.com/sumer5020" target="_blank" role="button"><i class="fa fa-pinterest"></i></a>
                                    </div>
                                    <div class="border-bottom rounded shadow-lg">
                                        <a class="media nav-link" href="{{route('language','ar')}}">Ar</a>
                                        <a class="media nav-link" href="{{route('language','en')}}">En</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <hr>
        <div class="d-flex justify-content-between feet">
            <p>
                <a href="{{ route('PrivacyPolicy') }}">Privacy Policy</a>
            </p>
            <p class="text-muted"><span>&copy; copyright {{ date("yy") }}</span></p>
        </div>
    </div>
    <script>
        $(function() {
            $('#Follow button').on('click',function(){
                $.ajax({
                headers: {
                    //request X-CSRF-TOKEN header
                    'X-CSRF-TOKEN': $('mata[name="csrf-token"]').attr('content')
                }
                , url: "{{ route('addfollow') }}"
                , type: 'POST'
                    // the type of data we expect back
                , dataType: 'json'
                    //with post must the data have _token input data
                , data: {
                    email: $('#Follow input').val()
                    , _token: '{{ csrf_token() }}'
                }
                //request success function with responce
                , success: function(data) {
                        $('#Follow input').val('');
                        $('#Follow').css('boxShadow','0 0 5px #4f4');
                        $('#Follow input').css('boxShadow','0 0 5px #4f4');
                        if (data['success'] == '201') {
                            $('#Follow input').prop('placeholder','{{ __("words.youAreAlreadyFollower") }}');
                        }
                        //done
                        else if (data['success'] == '200') {
                            $('#Follow input').prop('placeholder','{{ __("words.youAreInFollowersNow") }}');
                        }
                    }
                    //request error function
                , error: function(xhr, status) {
                    if (xhr['responseJSON']['message'] == 'The given data was invalid.') {
                        $('#Follow').css('boxShadow','0 0 5px #f44');
                        $('#Follow input').css('boxShadow','0 0 5px #f44');
                        $('.chat_footer input').val(senderMsg);
                    } else {
                        alert('Sorry,' + xhr['responseJSON']['message']);
                    }
                }
            });
            });
        });

    </script>
</footer>

