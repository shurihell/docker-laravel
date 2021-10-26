<div id="aside-left" class="aside aside-left perfect-scrollbar">
{{--    <div class="block bg-primary text-center" style="background-color: rgb(216, 5, 70); border-color: rgb(216, 5, 70); color: rgb(255, 255, 255); padding: 0px 0px 15px;margin-bottom: 0px;">--}}
    <div class="block bg-primary text-center" style="background-color: #0079cd; border-color: rgb(216, 5, 70); padding: 0px 0px 15px;margin-bottom: 0px;">
        <h1>
            <a href="/" style="color: rgb(255, 255, 255);">POSCO</a>
        </h1>
    </div>
    <div class="aside-profile">

        <div class="aside-profile-info">
            @if(Auth::check())

{{--                <span class="aside-profile-info-name"><a href="{{ route('member.edit', Auth::user()->id) }}">{{ Auth::user()->name }}</a></span>--}}
                <a href="{{ url("logout") }}" class="text-danger"><i class="fa fa-power-off"></i></a>

{{--                <h5 class="aside-profile-info-desc">{{ Auth::user()->email }} <span class="text-info">/ {{ \App\Helpers\UserHelper::get_role_info()['description'] }}</span></h5>--}}

            @else
                <div class="aside-profile-info-name">로그인이 필요합니다.</div>
            @endif

        </div>

    </div>

    <div class="navbar navbar-default">

        <div class="navbar-inner">

            <ul class="nav navbar-nav">

{{--                <li class="{!! Request::is('member*') ? 'active': '' !!}"><a href="{{ url('member') }}"><i class="fa fa-user"></i> 유저 관리</a></li>--}}
{{--                <li class="{!! Request::is('post*') ? 'active': '' !!}"><a href="{{ url('post') }}"><i class="fa fa-edit"></i> 학습 콘텐츠 관리</a></li>--}}
                <li class="{!! Request::is('member*') ? 'active': '' !!}"><a href="#"><i class="fa fa-user"></i> 유저 관리</a></li>
                <li class="{!! Request::is('post*') ? 'active': '' !!}"><a href="#"><i class="fa fa-edit"></i> 학습 콘텐츠 관리</a></li>
            </ul>

        </div>

    </div>

    <div class="aside-footer">

    </div>

</div>
