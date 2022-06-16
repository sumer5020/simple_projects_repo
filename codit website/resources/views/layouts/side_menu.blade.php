<ul class="list-unstyled components mb-5">
    <li><!--class="active"-->
        <a href="{{ route("welcome") }}"><span class="fa fa-delicious mr-3 notif">
        <!--<small class="d-flex align-items-center justify-content-center">5</small>-->
        </span> {{ __("words.home") }}</a>
    </li>

    <li>
        <a class="submenu" data-target="contents">
            <span class="fa fa-desktop mr-3"></span> {{ trans_choice("words.content",1) }}
        </a>
        <div class="pl-3" id="contents">
            <a href="{{ route("Cards.index") }}" class=""><span class="fa fa-square-o mr-3"></span> {{ trans_choice("words.headerCard",3) }}</a>
            <a href="{{ route("portfolio.index") }}" class=""><span class="fa fa-square-o mr-3"></span> {{ trans_choice("words.portfolio",3) }}</a>
            <a href="{{ route("offer.index") }}" class=""><span class="fa fa-square-o mr-3"></span> {{ trans_choice("words.offer",3) }}</a>
            <a href="{{ route("offer_request.index") }}" class=""><span class="fa fa-square-o mr-3"></span> {{ trans_choice("words.offerRequest",3) }}</a>
            <a href="{{ route("cati.index") }}" class=""><span class="fa fa-square-o mr-3"></span> {{ __("words.catigury") }}</a>
            <a href="{{ route("country.index") }}" class=""><span class="fa fa-square-o mr-3"></span> {{ __("control.country") }}</a>
            <a href="{{ route("gov.index") }}" class=""><span class="fa fa-square-o mr-3"></span> {{ __("control.gov") }}</a>
        </div>
    </li>

    <li>
        <a class="submenu" data-target="blog">
            <span class="fa fa-code mr-3"></span> {{ trans_choice("words.blog",1) }}
        </a>

        <div class="pl-3" id="blog">
            <a href="#" class=""><span class="fa fa-square-o mr-3"></span> blog</a>
        </div>
    </li>

    <li>
        <a href="{{ route('usersReport') }}" class="">
            <span class="fa fa-file-code-o mr-3"></span>{{ trans_choice('words.report',3) }}
        </a>
    </li>

    <li>
        <a class="submenu" data-target="chart">
            <span class="fa fa-pie-chart mr-3"></span>{{ trans_choice("words.chart",3) }}
        </a>

        <div class="pl-3" id="chart">
            <a href="#" class=""><span class="fa fa-square-o mr-3"></span> chart 1</a>
            <a href="#" class=""><span class="fa fa-square-o mr-3"></span> chart 2</a>
        </div>
    </li>

    <li>
        <a class="submenu" data-target="chat">
            <span class="fa fa-comments-o mr-3"></span>{{ trans_choice("words.chat",1) }}
            <small id="msg_count" style="color:lawngreen; {{ session()->has('unAnswersCount')?'':'display:none;' }}" class="position-absolute mx-2">{{ session()->has('unAnswersCount')?(session()->get('unAnswersCount')>0?session()->get('unAnswersCount'):''):'' }}</small>
        </a>

        <div class="pl-3" id="chat">
            <a href="{{ route('chat.index') }}" class=""><span class="fa fa-square-o mr-3"></span>{{ __('words.chatbot') }}</a>
            <a href="{{ route('chat_message.index') }}" class=""><span class="fa fa-square-o mr-3"></span> {{ trans_choice("words.chat",3)  }}</a>
        </div>
    </li>

    <li>
        <a class="submenu" data-target="users">
            <span class="fa fa-users mr-3"></span>{{ trans_choice("words.user",3) }}
        </a>

        <div class="pl-3" id="users">
            <a href="{{ route('user.index') }}" class=""><span class="fa fa-square-o mr-3"></span>{{ trans_choice('words.customer',3) }}</a>
            <a href="{{ route('admin') }}" class=""><span class="fa fa-square-o mr-3"></span>{{ trans_choice('words.admin',3) }}</a>
        </div>
    </li>

    @if(Auth::user()->isSouperAdmin())
    <li>
        <a class="submenu" data-target="admins">
            <span class="fa fa-users mr-3"></span>{{ trans_choice("words.admin",3) }}
        </a>

        <div class="pl-3" id="admins">
            <a href="{{ route('supperAdmin') }}" class=""><span class="fa fa-square-o mr-3"></span>{{ trans_choice('words.admin',3) }}</a>
        </div>
    </li>
    @endif

    <li>
        <a class="submenu" data-target="archive">
            <span class="fa fa-archive mr-3"></span>{{ trans_choice("words.archive",1) }}
        </a>

        <div class="pl-3" id="archive">
            <a href="#" class=""><span class="fa fa-terminal mr-3"></span> Log 1</a>
            <a href="#" class=""><span class="fa fa-terminal mr-3"></span> Log 2</a>
        </div>
    </li>

    <li>
        <a href="#"><span class="fa fa-cogs mr-3"></span> {{ trans_choice("words.setting",3) }}</a>
    </li>
    <li>
        <a href="#"><span class="fa fa-support mr-3"></span> {{ trans_choice("words.Support",1) }}</a>
    </li>
    <li>
        <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span class="fa fa-sign-out mr-3"></span> {{ __("words.logout") }}</a>
    </li>
</ul>
